<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }

   
    public function index()
    {
        return ProductCollection::collection(Product::paginate(5));
    }
    
    public function store(ProductRequest $request)
    {
       $product = new Product;
       $product->name = $request->name;
       $product->stock = $request->detail;
       $product->price = $request->price;
       $product->stock = $request->stock;
       $product->discount = $request->discount;
       $product->user_id = Auth::guard('api')->user()->id;

       $product->save();

       return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('This product does not exist, dude!');
        }
        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }
    
    public function update(ProductRequest $request, Product $product)
    {   
        $product->update($request->all());

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }
   
    public function destroy($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('This product does not exist, dude!');
        }
        $product->delete();
        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
