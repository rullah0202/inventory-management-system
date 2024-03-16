@extends('admin.layout.app')

@section('heading','Product Create')

@section('button')
    <a href="{{ route('product_show') }}" class="btn btn-primary"><i class="fas fa-view"></i> View</a>
@endsection

@section('main_content')
<div class="section-body">
    <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            <div class="form-group mb-1">
                                <label>Product Name*</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}">
                                @error('product_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label>Supplier Name*</label>
                                <select name="supplier_name" class="form-control @error('supplier_name') is-invalid @enderror">
                                    <option value="">Select Supplier</option>
                                    @foreach ($supplier as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    
                                </select>
                                @error('supplier_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label>Unit Name*</label>
                                <select name="unit_name" class="form-control @error('unit_name') is-invalid @enderror">
                                    <option value="">Select Unit</option>
                                    @foreach ($unit as $item)
                                        <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label>Category Name*</label>
                                <select name="category_name" class="form-control @error('category_name') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
</section>
@endsection