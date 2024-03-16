<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\validation\Rule;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;
use App\Models\Purchase;
use Auth;

class PurchaseController extends Controller
{
    public function purchase_show(){
        $purchase = Purchase::orderBy('date','desc')->orderBy('product_id','desc')->get();
        return view('admin.purchase.purchase_view',compact('purchase'));
    }

    public function purchase_create(){
        $product = Product::all();
        return view('admin.purchase.purchase_create',compact('product'));
    }

    public function purchase_store(Request $request){
        $purchase_data = new purchase;
        $request->validate([
            'purchase_no' => 'required',
            'date' => 'required',
            'buying_qty' => 'required',
        ]);

        if ($request->category_id == null) {

         return redirect()->back()->with('error','Sorry you do not select any item');

         } else {
     
             $count_category = count($request->category_id);
             for ($i=0; $i < $count_category; $i++) { 
                 $purchase = new Purchase();
                 $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                 $purchase->purchase_no = $request->purchase_no[$i];
                 $purchase->supplier_id = $request->supplier_id[$i];
                 $purchase->category_id = $request->category_id[$i];
     
                 $purchase->product_id = $request->product_id[$i];
                 $purchase->buying_qty = $request->buying_qty[$i];
                 $purchase->unit_price = $request->unit_price[$i];
                 $purchase->buying_price = $request->buying_price[$i];
                 $purchase->description = $request->description[$i];
     
                 $purchase->created_by = Auth::guard('admin')->user()->id;
                 $purchase->status = '0';
                 $purchase->save();
             } // end for

             return redirect()->route('purchase_show')->with('success','Data is saved successfully');
             
         } // end else    


    }

    public function purchase_delete($id){
        $purchase_data = Purchase::where('id',$id)->first();
        $purchase_data->delete();
        return redirect()->route('purchase_show')->with('success','Data is deleted successfully');
    }

    
    public function purchase_pending(){

        $purchase = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('admin.purchase.purchase_pending',compact('purchase'));
    }// End Method 

    public function purchase_approve($id){

        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){

            Purchase::findOrFail($id)->update([
                'status' => '1',
            ]);

            return redirect()->back()->with('success','Status Approved Successfully');
        }

    }// End Method
    
    public function DailyPurchaseReport(){
        return view('admin.purchase.daily_purchase_report');
    }// End Method 


    public function DailyPurchasePdf(Request $request){

        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Purchase::whereBetween('date',[$sdate,$edate])->where('status','1')->get();


        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        return view('admin.pdf.daily_purchase_report_pdf',compact('allData','start_date','end_date'));

    }// End Method 




}
