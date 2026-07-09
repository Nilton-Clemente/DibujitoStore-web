<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Banner;
use App\Models\Categoria;
use App\Models\Oferta;
use App\Models\Producto;
use App\Models\Promocion;

class HomeController extends Controller
{
    public function index()
    {
        $anuncios = Anuncio::where('activo', 1)->limit(2)->get();
        $promociones = Promocion::where('activo', 1)->limit(6)->get();

        $productosDestacados = Producto::with(['oferta', 'marca'])->limit(12)->get();

        $categorias = Categoria::limit(7)->get();

        $productosTecno = Producto::with(['oferta', 'marca'])
            ->where('categoria_id', 7)
            ->limit(5)
            ->get();

        $bannersPrincipales = Banner::where('ubicacion', 'contenedor_principal')->where('activo', 1)->get();
        $bannersSecundarios = Banner::where('ubicacion', 'contenedor_secundario')->where('activo', 1)->get();
        $bannersExtras = Banner::where('ubicacion', 'contenedor_extra')->where('activo', 1)->get();

        $productosOferta = Oferta::with('producto.marca')->where('activo', 1)->get();

        return view('home', compact(
            'anuncios',
            'promociones',
            'productosDestacados',
            'categorias',
            'productosTecno',
            'bannersPrincipales',
            'bannersSecundarios',
            'bannersExtras',
            'productosOferta'
        ));
    }
}
