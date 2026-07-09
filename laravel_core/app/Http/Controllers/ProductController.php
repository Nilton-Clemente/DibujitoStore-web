<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $producto = Producto::with(['marca', 'categoria', 'oferta'])->findOrFail($id);

        // Productos relacionados u otra logica
        $relacionados = Producto::where('categoria_id', $producto->categoria_id)
            ->where('id', '!=', $producto->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('producto', 'relacionados'));
    }

    public function search(Request $request)
    {
        $busqueda = trim((string) $request->query('busqueda', ''));
        $categoriaId = $request->query('categoria_id');

        $query = Producto::with(['marca', 'oferta']);

        if ($busqueda !== '') {
            $query->where('nombre', 'like', '%' . $busqueda . '%');
        } elseif (! empty($categoriaId)) {
            $query->where('categoria_id', $categoriaId);
        }

        $productos = $query->get();

        return view('products.search', compact('productos', 'busqueda', 'categoriaId'));
    }
}
