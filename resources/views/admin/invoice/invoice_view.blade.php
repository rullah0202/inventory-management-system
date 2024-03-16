@extends('admin.layout.app')

@section('heading','Invoice All')

@section('button')
    <a href="{{ route('invoice_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Customer Name</th> 
                                <th>Invoice No </th>
                                <th>Date </th>
                                <th>Desctipion</th>  
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>     
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $row['payment']['customer']['name'] }} </td> 
                                    <td> #{{ $row->invoice_no }} </td> 
                                    <td> {{ date('d-m-Y',strtotime($row->date))  }} </td> 
                                     <td>  {{ $row->description }} </td> 
                                    <td>  $ {{ $row['payment']['total_amount'] }} </td>                    
                                    <td> 
                                        @if($row->status == '0')
                                        <span class="btn btn-warning">Pending</span>
                                        @elseif($row->status == '1')
                                        <span class="btn btn-success">Approved</span>
                                        @endif
                                    </td> 
                                    <td> 
                                        @if($row->status == '0')
                                        
                                        <a href="{{ route('invoice_approve',$row->id) }}" class="btn btn-dark sm" title="Approved Data" >  <i class="fas fa-check-circle"></i> </a>

                                        <a href="{{ route('invoice_delete',$row->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
                                        @endif

                                        @if ($row->status == '1')
                                        <a href="{{ route('invoice_print',$row->id) }}" class="btn btn-danger sm" title="Print Invoice" >  <i class="fa fa-print"></i> </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection