<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function get_brand(){
        $brand = Brand::orderBy('id', 'desc')->get();
        return response()->json([
            'brand' => $brand
        ], 200);
    }

    public function delete_brand($id){
        $brand = Brand::findOrFail($id);
        if($brand) {
            $products = Product::where('brand_id', $id)->get();
            foreach($products as $product){
                // You can new category id or set null here
                // $product->category_id = 1;
                // $product->save();

                // you can delete all product related this category
                $product->delete();
            }
        }
        $brand->delete();
    }



    public function add_brand(Request $request){
        $request->validate([
            'brand_name' => 'required|string',
            'brand_img' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        $imagePath = $request->file('brand_img')->store('brand_img', 'public');
        $imagePath = asset('storage/'.$imagePath);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_img' =>  $imagePath,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            // 'newProduct' => $newProduct
            'message' => 'Brand added successfully'
        ]);
    }

}
