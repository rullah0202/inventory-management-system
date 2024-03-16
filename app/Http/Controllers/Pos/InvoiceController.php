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
use Illuminate\Support\Carbon;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Customer;
use DB;


class InvoiceController extends Controller
{
    
    public function invoice_show(){
        $invoices = Invoice::orderBy('date','desc')->orderBy('id','desc')->get();
            return view('admin.invoice.invoice_view',compact('invoices'));

    } // End Method

    public function invoice_create(){ 

        $product = Product::all();
        $costomer = Customer::all();
        $invoice_data = Invoice::orderBy('id','desc')->first();
        if ($invoice_data == null) {
           $firstReg = '0';
           $invoice_no = $firstReg+1;
        }else{
            $invoice_data = Invoice::orderBy('id','desc')->first()->invoice_no;
            $invoice_no = $invoice_data+1;
        }
        $date = date('Y-m-d');
        return view('admin.invoice.invoice_create',compact('invoice_no','product','date','costomer'));

    } // End Method

    public function invoice_store(Request $request){

        foreach($request->selling_qty as $key => $val){
            // $invoice_details = InvoiceDetail::where('id',$key)->first();
            // $product = Product::where('id',$invoice_details->product_id)->first();
            if($request->selling_qty[$key] > $request->current_stock_qty){

            return redirect()->back()->with('error','Sorry there is no Stock'); 

            }
        } // End foreach 

        $request->validate([
            'paid_status' => 'required',
            'customer_id' => 'required',
            'selling_qty' => 'required',
        ]);

        if ($request->category_id == null) {
    
        return redirect()->back()->with('error','Sorry You do not select any item');
    
        } else{
            if ($request->paid_amount > $request->estimated_amount) {
            return redirect()->back()->with('error','Sorry Paid Amount is Maximum the total price');
            } else {
        $invoice = new Invoice();
        $invoice->invoice_no = $request->invoice_no;
        $invoice->date = date('Y-m-d',strtotime($request->date));
        $invoice->description = $request->description;
        $invoice->status = '0';
        $invoice->created_by = Auth::guard('admin')->user()->id; 
    
        DB::transaction(function() use($request,$invoice){
            if ($invoice->save()) {
               $count_category = count($request->category_id);
               for ($i=0; $i < $count_category ; $i++) { 
    
                  $invoice_details = new InvoiceDetail();
                  $invoice_details->date = date('Y-m-d',strtotime($request->date));
                  $invoice_details->invoice_id = $invoice->id;
                  $invoice_details->category_id = $request->category_id[$i];
                  $invoice_details->product_id = $request->product_id[$i];
                  $invoice_details->selling_qty = $request->selling_qty[$i];
                  $invoice_details->unit_price = $request->unit_price[$i];
                  $invoice_details->selling_price = $request->selling_price[$i];
                  $invoice_details->status = '0'; 
                  $invoice_details->save(); 
               }
    
                if ($request->customer_id == '0') {
                    $customer = new Customer();
                    $request->validate([
                        'name' => 'required'
                    ]);
                    $customer->name = $request->name;
                    $customer->mobile_no = $request->mobile_no;
                    $customer->email = $request->email;
                    $customer->save();
                    $customer_id = $customer->id;
                } else{
                    $customer_id = $request->customer_id;
                } 
    
                $payment = new Payment();
                $payment_details = new PaymentDetail();
    
                $payment->invoice_id = $invoice->id;
                $payment->customer_id = $customer_id;
                $payment->paid_status = $request->paid_status;
                $payment->discount_amount = $request->discount_amount;
                $payment->total_amount = $request->estimated_amount;
    
                if ($request->paid_status == 'full_paid') {
                    $payment->paid_amount = $request->estimated_amount;
                    $payment->due_amount = '0';
                    $payment_details->current_paid_amount = $request->estimated_amount;
                } elseif ($request->paid_status == 'full_due') {
                    $payment->paid_amount = '0';
                    $payment->due_amount = $request->estimated_amount;
                    $payment_details->current_paid_amount = '0';
                }elseif ($request->paid_status == 'partial_paid') {
                    $payment->paid_amount = $request->paid_amount;
                    $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                    $payment_details->current_paid_amount = $request->paid_amount;
                }
                $payment->save();
    
                $payment_details->invoice_id = $invoice->id; 
                $payment_details->date = date('Y-m-d',strtotime($request->date));
                $payment_details->save(); 
            } 
    
                });
                
                return redirect()->route('invoice_show')->with('success','Invoice Data Inserted Successfully'); 
    
            } // end else 
        }

 
        } // End Method

        public function invoice_delete($id){

            $invoice = Invoice::findOrFail($id);
            $invoice->delete();
            InvoiceDetail::where('invoice_id',$invoice->id)->delete(); 
            Payment::where('invoice_id',$invoice->id)->delete(); 
            PaymentDetail::where('invoice_id',$invoice->id)->delete(); 
    
            return redirect()->back()->with('success','Invoice Deleted Successfully'); 
    
        }// End Method

        public function invoice_approve($id){

            $invoice = Invoice::with('invoice_details')->findOrFail($id);
            return view('admin.invoice.invoice_approve',compact('invoice'));
    
        }// End Method

        public function invoice_approve_store(Request $request, $id){

            foreach($request->selling_qty as $key => $val){
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $product = Product::where('id',$invoice_details->product_id)->first();
                if($product->quantity < $request->selling_qty[$key]){
    
                return redirect()->back()->with('error','Sorry you approve Maximum Value'); 
    
                }
            } // End foreach 
    
            $invoice = Invoice::findOrFail($id);
            $invoice->updated_by = Auth::guard('admin')->user()->id;
            $invoice->status = '1';
    
            DB::transaction(function() use($request,$invoice,$id){
                foreach($request->selling_qty as $key => $val){
                 $invoice_details = InvoiceDetail::where('id',$key)->first();
    
                 $invoice_details->status = '1';
                 if($invoice_details->save()){
                    $product = Product::where('id',$invoice_details->product_id)->first();
                    $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
                    $product->save();
                 }

                } // end foreach
    
                $invoice->save();
            });
    
        return redirect()->route('invoice_show')->with('success','Invoice Approve Successfully');  
    
        } // End Method

        public function invoice_print($id){
            $invoice = Invoice::with('invoice_details')->findOrFail($id);
            return view('admin.pdf.invoice_pdf',compact('invoice'));
    
        } // End Method

        public function DailyInvoiceReport(){
            return view('admin.invoice.daily_invoice_report');
        } // End Method
    
    
        public function DailyInvoicePdf(Request $request){
    
            $sdate = date('Y-m-d',strtotime($request->start_date));
            $edate = date('Y-m-d',strtotime($request->end_date));
            $allData = Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->get();
    
    
            $start_date = date('Y-m-d',strtotime($request->start_date));
            $end_date = date('Y-m-d',strtotime($request->end_date));
            return view('admin.pdf.daily_invoice_report_pdf',compact('allData','start_date','end_date'));
        } // End Method
    
    
    
}
