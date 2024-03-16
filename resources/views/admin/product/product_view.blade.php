@extends('admin.layout.app')

@section('heading','Products')

@section('button')
    <a href="{{ route('product_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
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
                                <th>Product Name</th>
                                <th>Supplier Name</th>
                                <th>Unit</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row['supplier']['name'] }}</td>
                                    <td>{{ $row['unit']['unit_name'] }}</td>
                                    <td>{{ $row['category']['category_name'] }}</td>
                                    <td class="pt_10 pb_10">
                                        <a href="{{ route('product_edit',$row->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('product_delete',$row->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
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