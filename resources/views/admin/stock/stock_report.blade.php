@extends('admin.layout.app')


@section('heading','Stock Report All')

@section('button')
    <a href="{{ route('stock.report.pdf') }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"> Stock Report Print </i></a>
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
                                    <th>Supplier Name </th>
                                    <th>Unit</th>
                                    <th>Category</th> 
                                    <th>Product Name</th> 
                                    <th>In Qty</th> 
                                    <th>Out Qty </th>  
                                    <th>Stock </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData as $key => $item)
                                    @php
                                    $buying_total = App\Models\Purchase::where('product_id',$item->id)->where('status','1')->sum('buying_qty');

                                    $selling_total = App\Models\InvoiceDetail::where('product_id',$item->id)->where('status','1')->sum('selling_qty');
                                    @endphp

                                    <tr>
                                        <td> {{ $key+1}} </td> 
                                        <td> {{ $item['supplier']['name'] }} </td> 
                                        <td> {{ $item['unit']['unit_name'] }} </td> 
                                        <td> {{ $item['category']['category_name'] }} </td> 
                                        <td> {{ $item->name }} </td> 
                                        <td> <span class="btn btn-success"> {{ $buying_total  }}</span>  </td> 
                                        <td> <span class="btn btn-info"> {{ $selling_total  }}</span> </td> 
                                        <td> <span class="btn btn-danger"> {{ $item->quantity }}</span> </td> 
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