
    @extends('admin.layout.app')

    @section('heading','Supplier Edit')
    
    @section('button')
        <a href="{{ route('supplier_show') }}" class="btn btn-primary"><i class="fas fa-view"></i> View</a>
    @endsection
    
    @section('main_content')
    <div class="section-body">
        <form action="{{ route('supplier_update',$supplier->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                                <div class="form-group mb-1">
                                    <label>Supplier Name</label>
                                    <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" value="{{ $supplier->name }}">
                                    @error('supplier_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-1">
                                    <label>Supplier Mobile No</label>
                                    <input type="text" class="form-control @error('supplier_mobile') is-invalid @enderror" name="supplier_mobile" value="{{ $supplier->mobile_no }}">
                                    @error('supplier_mobile')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-1">
                                    <label>Supplier Email</label>
                                    <input type="text" class="form-control @error('supplier_email') is-invalid @enderror" name="supplier_email" value="{{ $supplier->supplier_email }}">
                                    @error('supplier_email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-1">
                                    <label>Supplier Address</label>
                                    {{-- <input type="text" class="form-control @error('supplier_address') is-invalid @enderror" name="supplier_address" value="{{ $supplier->address }}"> --}}
                                    <textarea style="height: 60px" class="form-control @error('supplier_address') is-invalid @enderror" name="supplier_address" cols="30" rows="30">{!!$supplier->address !!}</textarea>
                                    @error('supplier_address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    </section>
    @endsection
