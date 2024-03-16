@extends('admin.layout.app')
@section('heading','Date Wise Invoice Report')
@section('main_content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <div class="row">
        <div class="col-12">
             
            <div class="row">
                <div class="col-6 mt-4">
                    <address>
                        <strong>Nahi Shop</strong><br>
                        Mirpur-1, Dhaka<br>
                        rullah0202@gmail.com
                    </address>
                </div>
                <div class="col-6 mt-4 text-end">
                    <address>
                       
                    </address>
                </div>
            </div>
        </div>
    </div>

      

    <div class="row">
        <div class="col-12">
            <div>
                <div class="p-2">
                    <h3 class="font-size-16"><strong>Invoice Report From &nbsp;
    <span class="btn btn-info"> {{ date('d-m-Y',strtotime($start_date)) }} </span> -
     <span class="btn btn-success"> {{ date('d-m-Y',strtotime($end_date)) }} </span>
                    </strong></h3>
                </div>
                
            </div>

        </div>
    </div> <!-- end row -->





   <div class="row">
        <div class="col-12">
            <div>
                <div class="p-2">
                     
                </div>
                <div class="">
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <td><strong>Sl </strong></td>
            <td class="text-center"><strong>Customer Name </strong></td>
            <td class="text-center"><strong>Invoice No  </strong>
            </td>
            <td class="text-center"><strong>Date</strong>
            </td>
            <td class="text-center"><strong>Description</strong>
            </td>
            <td class="text-center"><strong>Amount  </strong>
            </td>
            
            
        </tr>
        </thead>
        <tbody>
        <!-- foreach ($order->lineItems as $line) or some such thing here -->
        
      @php
        $total_sum = '0';
        @endphp
        @foreach($allData as $key => $item)
        <tr>
           <td class="text-center">{{ $key+1 }}</td>
            <td class="text-center">{{ $item['payment']['customer']['name'] }}</td>
            <td class="text-center">#{{ $item->invoice_no }}</td>
            <td class="text-center">{{ date('d-m-Y',strtotime($item->date)) }}</td>
            <td class="text-center">{{ $item->description }}</td>
            <td class="text-center">{{ $item['payment']['total_amount'] }}</td>
            
            
        </tr>
         @php
        $total_sum += $item['payment']['total_amount'];
        @endphp
        @endforeach
            
           
           
            <tr>
                <td class="no-line"></td>
                <td class="no-line"></td>
                <td class="no-line"></td> 
                <td class="no-line"></td>
                <td class="no-line text-center">
                    <strong>Grand Amount</strong></td>
                <td class="no-line text-end"><h4 class="m-0">${{ $total_sum}}</h4></td>
            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-print-none">
                        <div class="float-right">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- end row -->

 




</div>
</div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>


@endsection