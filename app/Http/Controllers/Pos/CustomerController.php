<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Auth;

class CustomerController extends Controller
{
    public function customer_show(){
        $customer = Customer::latest()->get();
        return view('admin.customer.customer_view',compact('customer'));
    }

    public function customer_create(){
        return view('admin.customer.customer_create');
    }

    public function customer_store(Request $request){
        $customer_data = new Customer;
        $request->validate([
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'customer_email' => 'required|email',
            'customer_address' => 'required'
        ]);

        if($request->hasFile('customer_image')) {
            
            $request->validate([
                'customer_image' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            $now = time();
            $ext = $request->file('customer_image')->extension();
            $final_name = 'customer_image_'.$now.'.'.$ext;
            $request->file('customer_image')->move('uploads/',$final_name);
            $customer_data->customer_image = 'uploads/'.$final_name;
            $customer_data->customer_image = $final_name;
        }

        $customer_data->name= $request->customer_name;
        $customer_data->mobile_no= $request->customer_mobile;
        $customer_data->email= $request->customer_email;
        $customer_data->address= $request->customer_address;
        $customer_data->created_by = Auth::guard('admin')->user()->id;
        $customer_data->save();

        return redirect()->route('customer_show')->with('success','Data is saved successfully');
    }

    public function customer_edit($id){
        $customer = Customer::where('id',$id)->first();
        return view('admin.customer.customer_edit',compact('customer'));
    }

    public function customer_update(Request $request,$id){

        $customer_data = Customer::where('id',$id)->first();

        $request->validate([
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'customer_email' => 'required|email',
            'customer_address' => 'required'
        ]);

        if($request->hasFile('customer_image')) {
            
            $request->validate([
                'customer_image' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            if($customer_data->customer_image!='')
            {
                unlink('uploads/'.$customer_data->customer_image);
            };
            $now = time();
            $ext = $request->file('customer_image')->extension();
            $final_name = 'customer_image_'.$now.'.'.$ext;
            $request->file('customer_image')->move('uploads/',$final_name);
            $customer_data->customer_image = 'uploads/'.$final_name;
            $customer_data->customer_image = $final_name;
        }

        $customer_data->name= $request->customer_name;
        $customer_data->mobile_no= $request->customer_mobile;
        $customer_data->email= $request->customer_email;
        $customer_data->address= $request->customer_address;
        $customer_data->updated_by = Auth::guard('admin')->user()->id;
        $customer_data->update();

        return redirect()->route('customer_show')->with('success','Data is updated successfully');
    }

    public function customer_delete($id){
            $customer_data = Customer::where('id',$id)->first();
            $customer_purchase_data = Payment::where('customer_id',$id)->count();
            if($customer_purchase_data > 0){
                return redirect()->route('customer_show')->with('error','Customer cannot be deleted as it is already in used');
            } else{

                if($customer_data->customer_image!='')
                {
                    unlink('uploads/'.$customer_data->customer_image);
                };
                $customer_data->delete();
                return redirect()->route('customer_show')->with('success','Data is deleted successfully');
            }
        }

        public function CreditCustomer(){

            $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
            return view('admin.customer.customer_credit',compact('allData'));
    
        } // End Method
    
    
        public function CreditCustomerPrintPdf(){
    
            $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
            return view('admin.pdf.customer_credit_pdf',compact('allData'));
    
        }// End Method
    
    
    
        public function CustomerEditInvoice($invoice_id){
    
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            return view('admin.customer.edit_customer_invoice',compact('payment'));
    
        }// End Method
    
    
        public function CustomerUpdateInvoice(Request $request,$invoice_id){
    
            if ($request->new_paid_amount < $request->paid_amount) {
    
                $notification = array(
                'message' => 'Sorry You Paid Maximum Value', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification); 
            } else{
                $payment = Payment::where('invoice_id',$invoice_id)->first();
                $payment_details = new PaymentDetail();
                $payment->paid_status = $request->paid_status;
    
                if ($request->paid_status == 'full_paid') {
                     $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                     $payment->due_amount = '0';
                     $payment_details->current_paid_amount = $request->new_paid_amount;
    
                } elseif ($request->paid_status == 'partial_paid') {
                    $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                    $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                    $payment_details->current_paid_amount = $request->paid_amount;
    
                }
    
                $payment->save();
                $payment_details->invoice_id = $invoice_id;
                $payment_details->date = date('Y-m-d',strtotime($request->date));
                $payment_details->updated_by = Auth::user()->id;
                $payment_details->save();
    
                  $notification = array(
                'message' => 'Invoice Update Successfully', 
                'alert-type' => 'success'
            );
            return redirect()->route('credit.customer')->with($notification); 
    
    
            }
    
        }// End Method
    
    
    
        public function CustomerInvoiceDetails($invoice_id){
    
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            return view('admin.pdf.invoice_details_pdf',compact('payment'));
    
        }// End Method
    
        public function PaidCustomer(){
            $allData = Payment::where('paid_status','!=','full_due')->get();
            return view('admin.customer.customer_paid',compact('allData'));
        }// End Method
    
        public function PaidCustomerPrintPdf(){
    
            $allData = Payment::where('paid_status','!=','full_due')->get();
            return view('admin.pdf.customer_paid_pdf',compact('allData'));
        }// End Method
    
    
        public function CustomerWiseReport(){
    
            $customers = Customer::all();
            return view('admin.customer.customer_wise_report',compact('customers'));
    
        }// End Method
    
    
        public function CustomerWiseCreditReport(Request $request){
    
             $allData = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
            return view('admin.pdf.customer_wise_credit_pdf',compact('allData'));
        }// End Method
    
    
        public function CustomerWisePaidReport(Request $request){
    
             $allData = Payment::where('customer_id',$request->customer_id)->where('paid_status','!=','full_due')->get();
            return view('admin.pdf.customer_wise_paid_pdf',compact('allData'));
        }// End Method
    
}
