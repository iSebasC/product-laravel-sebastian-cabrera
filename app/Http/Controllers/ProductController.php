<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

  public function index()
  {
      $products = Product::all();
  
      return response()->json([
          'success' => true,
          'message' => 'Lista de productos obtenida correctamente.',
          'data' => $products
      ], 200);
  }
  
  


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
        ], [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.unique' => 'El nombre del producto ya existe, elige otro.',
            'price.required' => 'El precio del producto es obligatorio.',
            'price.min' => 'El precio debe ser mayor a 0.',
            'stock.required' => 'La cantidad en stock es obligatoria.',
            'stock.min' => 'La cantidad en stock no puede ser negativa.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()
            ], 400);
        }

        $product = Product::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Producto creado exitosamente.',
            'product' => $product
        ], 201);
    }
    


    public function update(Request $request, $id)
    {
        // Validación usando Validator::make
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:products,name,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
        ], [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.unique' => 'El nombre del producto ya existe, elige otro.',
            'price.required' => 'El precio del producto es obligatorio.',
            'price.min' => 'El precio debe ser mayor a 0.',
            'stock.required' => 'La cantidad en stock es obligatoria.',
            'stock.min' => 'La cantidad en stock no puede ser negativa.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()
            ], 400);
        }

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado exitosamente.',
            'product' => $product
        ], 200);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Producto eliminado exitosamente'], 200);
    }
}
