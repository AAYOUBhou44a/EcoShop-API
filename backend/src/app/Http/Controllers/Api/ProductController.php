<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
//ProductController : lister/voir détails/filtrer par catégorie
class ProductController extends Controller
{
       
public function index(Request $request)
{
    $query = Product::query();

    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    $products = $query->paginate(10);

    return response()->json([
        'data' => $products->items(),
        'links' => [
            'first' => $products->url(1),
            'last' => $products->url($products->lastPage()),
            'prev' => $products->previousPageUrl(),
            'next' => $products->nextPageUrl(),
        ],
        'meta' => [
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
            'total' => $products->total(),
        ],
    ]);
}


    // Voir le détail d’un produit
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

     public function store(Request $request) { 
        $request->validate([
            'name'=>'sometimes|string|max:255',
            'description'=>'nullable|string',
            'price'=>'sometimes|numeric|min:0',
            'stock'=>'sometimes|integer|min:0',
            'category_id'=>'sometimes|exists:categories,id'
        ]);
        $product = Product::create($request->all());
        return response()->json($product,201);


      }
    public function update(Request $request, $id) { 
        $product = Product::findOrFail($id);
          $request->validate([
            'name'=>'sometimes|string|max:255',
            'description'=>'nullable|string',
            'price'=>'sometimes|numeric|min:0',
            'stock'=>'sometimes|integer|min:0',
            'category_id'=>'sometimes|exists:categories,id'
        ]);
        $product->update($request->all());
        return response()->json($product);

     }
    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message'=>'produit supprimer']);
     }

}