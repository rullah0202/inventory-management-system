@extends('admin.layout.app')
@section('heading','Credit Customer')
@section('button')
    <a href="{{ route('credit.customer.print.pdf') }}" class="btn btn-primary"><i class="fas fa-print"></i> Print Credit Customer</a>
@endsection
@section('main_content')


<div class="section-body">
    <div class="card">
        <div class="card-body">
    <div class="row">
        <div class="col-12">

                    

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Customer Name</th> 
                            <th>Invoice No </th>
                            <th>Date</th>
                            <th>Due Amount</th> 
                            <th>Action</th>
                            
                        </thead>


                        <tbody>
                        	 
                        	@foreach($allData as $key => $item)
    <tr>
        <td> {{ $key+1}} </td>
        <td> {{ $item['customer']['name'] }} </td> 
        <td> #{{ $item['invoice']['invoice_no'] }}   </td> 
        <td> {{  date('d-m-Y',strtotime($item['invoice']['date'])) }} </td> 
        <td> {{ $item->due_amount }} </td> 
        <td>
   <a href="{{ route('customer.edit.invoice',$item->invoice_id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

     <a href="{{ route('customer.invoice.details.pdf',$item->invoice_id) }}" target="_blank" class="btn btn-danger sm" title="Customer Invoice Details">  <i class="fa fa-eye"></i> </a>

                            </td>
                           
                        </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                     
                        
                    </div> <!-- container-fluid -->
                </div>
 

@endsection