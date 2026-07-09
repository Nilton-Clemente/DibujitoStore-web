<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->buildCartItems();

        return view('cart.index', compact('cartItems'));
    }

    public function panel()
    {
        $cartItems = $this->buildCartItems();

        return view('cart.panel', compact('cartItems'));
    }

    public function pay()
    {
        $cartItems = $this->buildCartItems();
        $totalGeneral = array_reduce($cartItems, fn($carry, $item) => $carry + ($item['precio'] * $item['cantidad']), 0);

        return view('cart.pay', compact('cartItems', 'totalGeneral'));
    }

    public function checkout()
    {
        $cartItems = $this->buildCartItems();

        if (empty($cartItems)) {
            return redirect()->route('cart.pay')->with('checkout_error', 'Tu carrito esta vacio. Agrega productos antes de continuar.');
        }

        $totalGeneral = $this->calculateTotal($cartItems);

        return view('cart.checkout', compact('cartItems', 'totalGeneral'));
    }

    /**
     * Creates a demo order. Card fields are deliberately not accepted by this endpoint.
     */
    public function confirmPayment(Request $request)
    {
        $request->validate([]);
        $userId = (int) Auth::id();

        $order = DB::transaction(function () use ($userId) {
            $cartItems = $this->buildCartItems();

            if (empty($cartItems)) {
                abort(422, 'Tu carrito esta vacio.');
            }

            $subtotal = $this->calculateTotal($cartItems);
            $codigo = $this->generateOrderCode();
            $now = now();

            $pedidoId = DB::table('pedidos')->insertGetId([
                'usuario_id' => $userId,
                'codigo' => $codigo,
                'subtotal' => $subtotal,
                'envio' => 0,
                'total' => $subtotal,
                'estado' => 'confirmado',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($cartItems as $item) {
                DB::table('detalle_pedidos')->insert([
                    'pedido_id' => $pedidoId,
                    'producto_id' => $item['id'],
                    'nombre_producto' => $item['nombre'],
                    'imagen_producto' => $item['imagen'],
                    'precio_unitario' => $item['precio'],
                    'cantidad' => $item['cantidad'],
                    'subtotal' => $item['precio'] * $item['cantidad'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $cart = DB::table('carrito')->where('usuario_id', $userId)->first();
            if ($cart) {
                DB::table('detalle_carrito')->where('carrito_id', $cart->id)->delete();
            }

            return (object) ['id' => $pedidoId, 'codigo' => $codigo];
        });

        return response()->json([
            'redirect' => route('cart.confirmation', ['codigo' => $order->codigo]),
        ]);
    }

    public function confirmation(string $codigo)
    {
        $pedido = DB::table('pedidos')
            ->where('codigo', $codigo)
            ->where('usuario_id', (int) Auth::id())
            ->first();

        abort_unless($pedido, 404);

        $items = DB::table('detalle_pedidos')
            ->where('pedido_id', $pedido->id)
            ->orderBy('id')
            ->get();

        return view('cart.confirmation', compact('pedido', 'items'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'producto_id' => ['required', 'integer', 'exists:productos,id'],
        ]);

        $cartId = $this->getOrCreateCartId();
        $productId = (int) $data['producto_id'];

        $existingItem = DB::table('detalle_carrito')
            ->where('carrito_id', $cartId)
            ->where('producto_id', $productId)
            ->first();

        if ($existingItem) {
            DB::table('detalle_carrito')
                ->where('carrito_id', $cartId)
                ->where('producto_id', $productId)
                ->update(['cantidad' => (int) $existingItem->cantidad + 1]);
        } else {
            DB::table('detalle_carrito')->insert([
                'carrito_id' => $cartId,
                'producto_id' => $productId,
                'cantidad' => 1,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'producto_id' => ['required', 'integer'],
        ]);

        $cartId = $this->getOrCreateCartId();

        DB::table('detalle_carrito')
            ->where('carrito_id', $cartId)
            ->where('producto_id', (int) $data['producto_id'])
            ->delete();

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'producto_id' => ['required', 'integer'],
            'cantidad' => ['required', 'integer', 'min:1'],
        ]);

        $cartId = $this->getOrCreateCartId();

        DB::table('detalle_carrito')
            ->where('carrito_id', $cartId)
            ->where('producto_id', (int) $data['producto_id'])
            ->update(['cantidad' => (int) $data['cantidad']]);

        return response()->json(['success' => true]);
    }

    private function buildCartItems(): array
    {
        $userId = (int) Auth::id();

        if ($userId <= 0) {
            return [];
        }

        $rows = DB::table('detalle_carrito as dc')
            ->join('carrito as c', 'dc.carrito_id', '=', 'c.id')
            ->join('productos as p', 'dc.producto_id', '=', 'p.id')
            ->leftJoin('ofertas as o', function ($join) {
                $join->on('p.id', '=', 'o.producto_id')->where('o.activo', '=', 1);
            })
            ->where('c.usuario_id', $userId)
            ->selectRaw('dc.producto_id as id, dc.cantidad, p.nombre, p.imagen, IFNULL(p.precio - (p.precio * o.porcentaje / 100), p.precio) as precio')
            ->get();

        return $rows
            ->map(fn($row) => [
                'id' => (int) $row->id,
                'nombre' => $row->nombre,
                'imagen' => $row->imagen,
                'precio' => (float) $row->precio,
                'cantidad' => (int) $row->cantidad,
            ])
            ->all();
    }

    private function calculateTotal(array $cartItems): float
    {
        return array_reduce($cartItems, fn ($total, $item) => $total + ($item['precio'] * $item['cantidad']), 0.0);
    }

    private function generateOrderCode(): string
    {
        do {
            $code = 'ORD-' . strtoupper(bin2hex(random_bytes(4)));
        } while (DB::table('pedidos')->where('codigo', $code)->exists());

        return $code;
    }

    private function getOrCreateCartId(): int
    {
        $userId = (int) Auth::id();

        $existingCart = DB::table('carrito')->where('usuario_id', $userId)->first();

        if ($existingCart) {
            return (int) $existingCart->id;
        }

        return (int) DB::table('carrito')->insertGetId([
            'usuario_id' => $userId,
        ]);
    }
}
