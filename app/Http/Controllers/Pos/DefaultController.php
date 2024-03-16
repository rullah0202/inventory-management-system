<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use Auth;

class DefaultController extends Controller
{
    public function GetCategory(Request $request){

        $product_id = $request->product_id;
        // dd($supplier_id);
        $allCategory = Product::with(['category'])->select('category_id')->where('id',$product_id)->first();
        return response()->json($allCategory);
    } // End Mehtod
    
    public function GetSupplier(Request $request){

        $product_id = $request->product_id;
        // dd($supplier_id);
        $allSupplier = Product::with(['supplier'])->select('supplier_id')->where('id',$product_id)->first();
        return response()->json($allSupplier);
    } // End Mehtod 

    public function GetStock(Request $request){
        $product_id = $request->product_id;
        $stock = Product::where('id',$product_id)->first()->quantity;
        return response()->json($stock);

    } // End Mehtod 


}
