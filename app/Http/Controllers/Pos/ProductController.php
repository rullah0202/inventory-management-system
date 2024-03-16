<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;
use App\Models\Purchase;
use Auth;

class ProductController extends Controller
{
    public function product_show(){
        $product = Product::latest()->get();
        return view('admin.product.product_view',compact('product'));
    }

    public function product_create(){
        $unit = Unit::all();
        $category = Category::all();
        $supplier = Supplier::all();
        return view('admin.product.product_create',compact('unit','category','supplier'));
    }

    public function product_store(Request $request){
        $product_data = new Product;
        $request->validate([
            'product_name' => 'required',
            'supplier_name' => 'required',
            'unit_name' => 'required',
            'category_name' => 'required'
        ]);

        $product_data->name= $request->product_name;
        $product_data->supplier_id= $request->supplier_name;
        $product_data->unit_id= $request->unit_name;
        $product_data->category_id= $request->category_name;
        $product_data->created_by = Auth::guard('admin')->user()->id;
        $product_data->save();

        return redirect()->route('product_show')->with('success','Data is saved successfully');
    }

    public function product_edit($id){
        $product = Product::where('id',$id)->first();
        $unit = Unit::all();
        $category = Category::all();
        $supplier = Supplier::all();
        return view('admin.product.product_edit',compact('product','unit','category','supplier'));
    }

    public function product_update(Request $request,$id){

        $product_data = Product::where('id',$id)->first();

        $request->validate([
            'product_name' => 'required',
            'supplier_name' => 'required',
            'unit_name' => 'required',
            'category_name' => 'required'
        ]);

        $product_data->name= $request->product_name;
        $product_data->supplier_id= $request->supplier_name;
        $product_data->unit_id= $request->unit_name;
        $product_data->category_id= $request->category_name;
        $product_data->updated_by = Auth::guard('admin')->user()->id;
        $product_data->update();

        return redirect()->route('product_show')->with('success','Data is updated successfully');
    }

    public function product_delete($id){
            $product_data = Product::where('id',$id)->first();
            $product_purcase_data = Purchase::where('product_id',$id)->count();


            if($product_purcase_data> 0){
                return redirect()->route('product_show')->with('error','Product cannot be deleted as it is already used in Purchase');
            } else{
                $product_data->delete();
                return redirect()->route('product_show')->with('success','Data is deleted successfully');
            }
        }
}
