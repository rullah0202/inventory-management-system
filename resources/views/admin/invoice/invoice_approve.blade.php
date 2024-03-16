@extends('admin.layout.app')

@section('heading','Invoice Approve')

@section('button')
    <a href="{{ route('invoice_show') }}" class="btn btn-primary"> Invoice All</a>
@endsection

@section('main_content')
<div class="section-body">
    @php
    $payment = App\Models\Payment::where('invoice_id',$invoice->id)->first();
    @endphp                    

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Invoice No: #{{ $invoice->invoice_no }} - Date: {{ date('d-m-Y',strtotime($invoice->date)) }} </h4>
                    {{-- <a href="{{ route('invoice.pending.list') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fa fa-list"> Pending Invoice List </i></a> <br>  <br>                --}}

                    <table class="table table-bordered" width="100%">
                        <tbody>
                            <tr>
                                <td><p> Customer Info </p></td>
                                <td><p> Name: <strong> {{ $payment['customer']['name']  }} </strong> </p></td>
                                <td><p> Mobile: <strong> {{ $payment['customer']['mobile_no']  }} </strong> </p></td>
                            <td><p> Email: <strong> {{ $payment['customer']['email']  }} </strong> </p></td>                
                            </tr>

                            <tr>
                            <td></td>
                            <td colspan="3"><p> Description : <strong> {{ $invoice->description  }} </strong> </p></td>
                            </tr>
                        </tbody>
                        
                    </table>    


                    <form method="post" action="{{ route('invoice_approve_store',$invoice->id) }}">
                    @csrf         
                        <table  class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Current Stock</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Unit Price </th>
                                    <th class="text-center">Total Price</th>
                                </tr>
                                
                            </thead>
                    <tbody>
                        @php
                        $total_sum = '0';
                        @endphp
                        @foreach($invoice['invoice_details'] as $key => $details)
                        <tr>
                            
                            <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                            <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                            <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{ $details->selling_qty }}">

                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center">{{ $details['category']['category_name'] }}</td>
                            <td class="text-center">{{ $details['product']['name'] }}</td>
                            <td class="text-center">{{ $details['product']['quantity'] }}</td>
                            <td class="text-center">{{ $details->selling_qty }}</td>
                            <td class="text-center">{{ $details->unit_price }}</td>
                            <td class="text-center">{{ $details->selling_price }}</td>
                        </tr>
                        @php
                        $total_sum += $details->selling_price;
                        @endphp
                        @endforeach
                        <tr>
                            <td colspan="6"> Sub Total </td>
                            <td > {{ $total_sum }} </td>
                        </tr>
                        <tr>
                            <td colspan="6"> Discount </td>
                            <td > {{ $payment->discount_amount }} </td>
                        </tr>

                        <tr>
                            <td colspan="6"> Paid Amount </td>
                            <td >{{ $payment->paid_amount }} </td>
                        </tr>

                        <tr>
                            <td colspan="6"> Due Amount </td>
                            <td > {{ $payment->due_amount }} </td>
                        </tr>

                        <tr>
                            <td colspan="6"> Grand Amount </td>
                            <td >{{ $payment->total_amount }}</td>
                        </tr>
                    </tbody>
                            
                        </table>
                
                        <button type="submit" class="btn btn-info">Invoice Approve </button>

                    </form> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection