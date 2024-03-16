@extends('admin.layout.app')

@section('heading','Supplier and Category Wise Report ')
@section('main_content')

<div class="section-body">
    <div class="card">
        <div class="card-body">
             <div class="row">               
                <div class="col-md-12 text-center">
                    <strong> Supplier Wise Report </strong>
                    <input type="radio" name="supplier_category_wise" value="supplier_wise" class="search_value">
                    &nbsp;&nbsp;
                    <strong> Category Wise Report </strong>
                    <input type="radio" name="supplier_category_wise" value="category_wise" class="search_value">
                </div>        
            </div> <!-- // end row  -->

<!--  /// Supplier Wise  -->
    <div class="show_supplier" style="display:none">
        <form method="GET" action="{{ route('supplier_wise_pdf') }}" id="myForm" target="_blank" >

            <div class="row">
                <div class="col-sm-8 form-group">
                    <label for="example-text-input" class="form-label">Supplier Name </label>
                    <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror select2"  >
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supp)
                            <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                        @endforeach
                    </select> 
                    @error('supplier_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror                   
                </div>

                <div class="col-sm-4" style="padding-top: 40px;">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
                
            </div>
            
        </form>
        
    </div>
<!--  /// End Supplier Wise  -->

<!--  /// Category Wise  -->
 <div class="show_category" style="display:none; ">
        <form method="GET" action="{{ route('category_wise_pdf') }}" id="myFormCat" target="_blank" >

            <div class="row">

               <div class="col-md-8 form-group">
                <label for="example-text-input" class="form-label">Category Name </label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror select2" >
                    <option value="">Select Category</option>
                    @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror     
            </div>

                <div class="col-sm-4" style="padding-top: 40px;">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
                
            </div>
            
        </form>
 </div>
    </div>
<!--  /// End Product Wise  -->




                    
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                     
                        
                    </div> <!-- container-fluid -->
                </div>

{{-- <script type="text/javascript">
    $(function(){
        $(document).on('change','#category_id',function(){
            var category_id = $(this).val();
            $.ajax({
                url:"{{ route('get-product') }}",
                type: "GET",
                data:{category_id:category_id},
                success:function(data){
                    var html = '<option value="">Select Category</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.id+' "> '+v.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            })
        });
    });

</script> --}}


<script type="text/javascript">
    $(document).on('change','.search_value', function(){
        var search_value = $(this).val();
        if (search_value == 'supplier_wise') {
            $('.show_supplier').show();
        }else{
            $('.show_supplier').hide();
        }
    }); 

</script>


<script type="text/javascript">
    $(document).on('change','.search_value', function(){
        var search_value = $(this).val();
        if (search_value == 'category_wise') {
            $('.show_category').show();
        }else{
            $('.show_category').hide();
        }
    }); 

</script>



 <script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                supplier_id: {
                    required : true,
                }, 
                  
            },
            messages :{
                supplier_id: {
                    required : 'Please Select Supplier ',
                },
                
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myFormCat').validate({
            rules: {
                category_id: {
                    required : true,
                }, 
                  
            },
            messages :{
                category_id: {
                    required : 'Please Select Category ',
                },
                
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>
 

@endsection