@extends('admin.layout.app')

@section('heading','Purchase')

@section('button')
    <a href="{{ route('purchase_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
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
                                <th>SL</th>
                                <th>Purhase No</th>
                                <th>Date </th>
                                <th>Supplier</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Product Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->purchase_no}}</td>
                                    <td>{{ date('d-m-Y',strtotime($row->date))  }}</td>
                                    <td> {{ $row['supplier']['name'] }} </td> 
                                    <td> {{ $row['category']['category_name'] }} </td> 
                                    <td> {{ $row->buying_qty }} </td> 
                                    <td> {{ $row['product']['name'] }} </td> 
                                    <td> 
                                        @if($row->status == '0')
                                        <span class="btn btn-warning">Pending</span>
                                        @elseif($row->status == '1')
                                        <span class="btn btn-success">Approved</span>
                                        @endif
                                    </td> 
                                    <td> 
                                        @if($row->status == '0')

                                        <a href="{{ route('purchase_approve',$row->id) }}" class="btn btn-dark sm" title="Approved Data" >  <i class="fas fa-check-circle"></i> </a>

                                        <a href="{{ route('purchase_delete',$row->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
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