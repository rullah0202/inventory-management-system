
    @extends('admin.layout.app')

    @section('heading','Customer Edit')
    
    @section('button')
        <a href="{{ route('customer_show') }}" class="btn btn-primary"><i class="fas fa-view"></i> View</a>
    @endsection
    
    @section('main_content')
    <div class="section-body">
        <form action="{{ route('customer_update',$customer->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Customer Image</label>
                                    <img id="showImage" src="{{ (!empty($customer->customer_image) ? asset('uploads/'.$customer->customer_image) : asset('uploads/no_image.jpg') )}}" 
                                    alt="" class="profile-photo w_100_p">
                                    <input id="image" type="file" class="form-control mt_10" name="customer_image">
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Customer Name *</label>
                                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ $customer->name }}">
                                        @error('customer_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Customer Mobile *</label>
                                        <input type="text" class="form-control  @error('customer_mobile') is-invalid @enderror" name="customer_mobile" value="{{ $customer->mobile_no }}">
                                        @error('customer_mobile')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Customer Email*</label>
                                        <input type="text" class="form-control @error('customer_email') is-invalid @enderror" name="customer_email" value="{{ $customer->email }}">
                                        @error('customer_email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Customer Address*</label>
                                        <textarea style="height: 60px" class="form-control @error('customer_address') is-invalid @enderror" name="customer_address" cols="30" rows="30">{!!$customer->address !!}</textarea>
                                        @error('customer_address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
    <script type="text/javascript">
    
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    
    </script>
    @endsection
