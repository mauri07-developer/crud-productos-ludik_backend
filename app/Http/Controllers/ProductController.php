<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::where('estado',1)->get();
    }

    // Crear un nuevo producto
    public function create()
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Crear el producto
        $product = Product::create($request->all());

        // Retornar el producto creado con un código de estado 201
        return response()->json($product, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // Mostrar un producto específico
    public function show(Product $product)
    {
        $product = Product::where('id', $id)->where('estado', 1)->first();

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado o inactivo'], 404);
        }
        
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    // Actualizar un producto existente
    public function update(Request $request, Product $product)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric',
            'stock' => 'integer',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Producto eliminado con éxito']);
    }
}
