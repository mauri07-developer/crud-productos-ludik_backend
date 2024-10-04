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
    public function create(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'precio' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
            ]);
    
            // Crear el producto
            $product = Product::create($request->all());
    
            // Retornar la respuesta con código 200 y mensaje de éxito
            return response()->json([
                'code' => 200,
                'message' => 'Producto registrado correctamente',
                'status' => true,
                'product' => $product // También puedes incluir el producto creado si lo deseas
            ], 200);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Retornar la respuesta con código 500 y el mensaje de error de validación
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(), // Mensaje de error de validación
                'status' => false
            ], 500);
        } catch (\Exception $e) {
            // Capturar cualquier otra excepción y retornar un mensaje genérico
            return response()->json([
                'code' => 500,
                'message' => 'Ocurrió un error al registrar el producto',
                'status' => false
            ], 500);
        }
    }


    // Mostrar un producto específico
    public function show($id)
    {
        $product = Product::where('id', $id)->where('estado', 1)->first();

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado o inactivo'], 404);
        }
        
        return response()->json($product);
    }


    // Actualizar un producto existente
    public function update(Request $request, $id)
    {
        // Buscar el producto por ID
        $product = Product::find($id);

        // Verificar si el producto existe
        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => 'Producto no encontrado',
                'status' => false
            ], 404);
        }

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'string|max:255',
            'descripcion' => 'string|max:255',
            'precio' => 'numeric|min:0',
            'stock' => 'integer|min:0',
        ]);

        // Actualizar el producto
        $product->update($request->all());

        return response()->json([
            'code' => 200,
            'message' => 'Producto actualizado correctamente',
            'status' => true,
            'product' => $product // También puedes incluir el producto actualizado si lo deseas
        ], 200);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        // Buscar el producto por ID
        $product = Product::find($id);

        // Verificar si el producto existe
        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => 'Producto no encontrado',
                'status' => false
            ], 404);
        }

        // Cambiar el estado del producto a 0 (inactivo)
        $product->estado = 0;
        $product->save();

        return response()->json([
            'code' => 200,
            'message' => 'Producto eliminado con éxito',
            'status' => true
        ], 200);
    }
}
