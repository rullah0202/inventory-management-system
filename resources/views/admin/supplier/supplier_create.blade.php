@extends('admin.layout.app')

@section('heading','Supplier Create')

@section('button')
    <a href="{{ route('supplier_show') }}" class="btn btn-primary"><i class="fas fa-view"></i> View</a>
@endsection

@section('main_content')
<div class="section-body">
    <form action="{{ route('supplier_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            <div class="form-group mb-1">
                                <label>Supplier Name*</label>
                                <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" value="{{ old('supplier_name') }}">
                                @error('supplier_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label>Supplier Mobile*</label>
                                <input type="text" class="form-control  @error('supplier_mobile') is-invalid @enderror" name="supplier_mobile" value="{{ old('supplier_mobile') }}">
                                @error('supplier_mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label>Supplier Email*</label>
                                <input type="text" class="form-control @error('supplier_email') is-invalid @enderror" name="supplier_email" value="{{ old('supplier_email') }}">
                                @error('supplier_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label>Supplier Address*</label>
                                <textarea style="height: 60px" class="form-control @error('supplier_address') is-invalid @enderror" name="supplier_address" cols="30" rows="30">{{ old('supplier_address') }}</textarea>
                                {{-- <input type="text" class="form-control @error('supplier_address') is-invalid @enderror" name="supplier_address" value="{{ old('supplier_address') }}"> --}}
                                @error('supplier_address')
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