<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use Auth;

class SupplierController extends Controller
{
    public function supplier_show(){
        $supplier = supplier::latest()->get();
        return view('admin.supplier.supplier_view',compact('supplier'));
    }

    public function supplier_create(){
        return view('admin.supplier.supplier_create');
    }

    public function supplier_store(Request $request){
        $supplier_data = new Supplier;
        $request->validate([
            'supplier_name' => 'required',
            'supplier_mobile' => 'required',
            'supplier_email' => 'required|email|unique:suppliers',
            'supplier_address' => 'required'
        ]);

        $supplier_data->name= $request->supplier_name;
        $supplier_data->mobile_no= $request->supplier_mobile;
        $supplier_data->supplier_email= $request->supplier_email;
        $supplier_data->address= $request->supplier_address;
        $supplier_data->created_by = Auth::guard('admin')->user()->id;
        $supplier_data->save();

        return redirect()->route('supplier_show')->with('success','Data is saved successfully');
    }

    public function supplier_edit($id){
        $supplier = supplier::where('id',$id)->first();
        return view('admin.supplier.supplier_edit',compact('supplier'));
    }

    public function supplier_update(Request $request,$id){

        $supplier_data = supplier::where('id',$id)->first();

        $request->validate([
            'supplier_name' => 'required',
            'supplier_mobile' => 'required',
            'supplier_email' => [
                'required',
                'email',
                Rule::unique('suppliers')->ignore($supplier_data->id)
            ],
            'supplier_address' => 'required'
        ]);

        $supplier_data->name= $request->supplier_name;
        $supplier_data->mobile_no= $request->supplier_mobile;
        $supplier_data->supplier_email= $request->supplier_email;
        $supplier_data->address= $request->supplier_address;
        $supplier_data->updated_by = Auth::guard('admin')->user()->id;
        $supplier_data->update();

        return redirect()->route('supplier_show')->with('success','Data is updated successfully');
    }

    public function supplier_delete($id){
            $supplier_data = Supplier::where('id',$id)->first();
            $product_supplier_data = Product::where('supplier_id',$id)->count();

            if($product_supplier_data > 0){
                return redirect()->route('supplier_show')->with('error','Supplier cannot be deleted as it is already used in Products');
            } else{
                $supplier_data->delete();
                return redirect()->route('supplier_show')->with('success','Data is deleted successfully');
            }

        }

}
