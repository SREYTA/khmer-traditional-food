<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'ingredient'=>'required',
            'direction'=>'required',
            'image'=>'required'
        ]);

        // Create a new Product
        $product = new Product;
        $product->name = $request->name;
        $product->ingredient = $request->ingredient;
        $product->direction = $request->direction;
        $product->image = $request->image;
        $product->save();
        return  response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name !== null ? $request->name : $product->name;
        $product->ingredient = $request->ingredient !== null ? $request->ingredient : $product->ingredient;
        $product->direction = $request->direction !== null ? $request->direction : $product->direction;
        $product->image = $request->image !== null ? $request->image : $product->image;
        $product->update();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::destroy($id);
        if($product){
            return ["message" => "Delete Successfully!!!"];
        }else {
            return ["message" => "Delete Failed!!!"];
        }
    }
}
