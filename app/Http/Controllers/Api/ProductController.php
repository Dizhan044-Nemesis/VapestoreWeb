<?php

namespace App\Http\Controllers\Api;

// Import model Product
use App\Models\Product;

use App\Http\Controllers\Controller;

// Import resource ProductResource
use App\Http\Resources\ProductResource;

// Import Http request
use Illuminate\Http\Request;

// Import facade Validator
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all products
        $products = Product::latest()->paginate(5);

        // Return collection of products as a resource
        return new ProductResource(true, 'List Data Products', $products);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create product
        $product = Product::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        // Return response
        return new ProductResource(true, 'Data Product Berhasil Ditambahkan!', $product);
    }

    /**
     * show
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return new ProductResource(true, 'Detail Data Product!', $product);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find product by ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Update product
        $product->update([
            'name'        => $request->name,
            'category'    => $request->category,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        // Return response
        return new ProductResource(true, 'Data Product Berhasil Diubah!', $product);
    }

    /**
     * delete
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        // Find product by ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Delete product
        $product->delete();

        // Return response
        return new ProductResource(true, 'Data Product Berhasil Dihapus!', null);
    }
}
