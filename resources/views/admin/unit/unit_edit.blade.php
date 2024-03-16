
    @extends('admin.layout.app')

    @section('heading','Unit Edit')
    
    @section('button')
        <a href="{{ route('unit_show') }}" class="btn btn-primary"><i class="fas fa-view"></i> View</a>
    @endsection
    
    @section('main_content')
    <div class="section-body">
        <form action="{{ route('unit_update',$unit->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                                <div class="form-group mb-1">
                                    <label>Unit Name</label>
                                    <input type="text" class="form-control @error('unit_name') is-invalid @enderror" name="unit_name" value="{{ $unit->unit_name }}">
                                    @error('unit_name')
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