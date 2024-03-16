<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;

class CategoryController extends Controller
{
    public function category_show(){
        $category = Category::latest()->get();
        return view('admin.category.category_view',compact('category'));
    }

    public function category_create(){
        return view('admin.category.category_create');
    }

    public function category_store(Request $request){
        $category_data = new Category;
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);

        $category_data->category_name= $request->category_name;
        $category_data->created_by = Auth::guard('admin')->user()->id;
        $category_data->save();

        return redirect()->route('category_show')->with('success','Data is saved successfully');
    }

    public function category_edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.category_edit',compact('category'));
    }

    public function category_update(Request $request,$id){

        $category_data = Category::where('id',$id)->first();

        $request->validate([
            'category_name' => [
                'required',
                Rule::unique('categories')->ignore($category_data->id)
            ] 
        ]);

        $category_data->category_name= $request->category_name;
        $category_data->updated_by = Auth::guard('admin')->user()->id;
        $category_data->update();

        return redirect()->route('category_show')->with('success','Data is updated successfully');
    }

    public function category_delete($id){
            $category_data = Category::where('id',$id)->first();
            $product_category_data = Product::where('category_id',$id)->count();


            if($product_category_data > 0){
                return redirect()->route('category_show')->with('error','Category cannot be deleted as it is already used in Products');
            } else{
                $category_data->delete();
                return redirect()->route('category_show')->with('success','Data is deleted successfully');
            }
        }
}
