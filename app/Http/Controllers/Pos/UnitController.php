<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Unit;
use App\Models\Product;
use Auth;

class UnitController extends Controller
{
    public function unit_show(){
        $unit = Unit::latest()->get();
        return view('admin.unit.unit_view',compact('unit'));
    }

    public function unit_create(){
        return view('admin.unit.unit_create');
    }

    public function unit_store(Request $request){
        $unit_data = new Unit;
        $request->validate([
            'unit_name' => 'required|unique:units'
        ]);

        $unit_data->unit_name= $request->unit_name;
        $unit_data->created_by = Auth::guard('admin')->user()->id;
        $unit_data->save();

        return redirect()->route('unit_show')->with('success','Data is saved successfully');
    }

    public function unit_edit($id){
        $unit = Unit::where('id',$id)->first();
        return view('admin.unit.unit_edit',compact('unit'));
    }

    public function unit_update(Request $request,$id){

        $unit_data = Unit::where('id',$id)->first();

        $request->validate([
            'unit_name' => [
                'required',
                Rule::unique('units')->ignore($unit_data->id)
            ]
        ]);

        $unit_data->unit_name= $request->unit_name;
        $unit_data->updated_by = Auth::guard('admin')->user()->id;
        $unit_data->update();

        return redirect()->route('unit_show')->with('success','Data is updated successfully');
    }

    public function unit_delete($id){
            $unit_data = Unit::where('id',$id)->first();
            $product_unit_data = Product::where('unit_id',$id)->count();


            if($product_unit_data > 0){
                return redirect()->route('unit_show')->with('error','Unit cannot be deleted as it is already used in Products');
            } else{
                $unit_data->delete();
                return redirect()->route('unit_show')->with('success','Data is deleted successfully');
            }
        }
}
