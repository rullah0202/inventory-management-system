@extends('admin.layout.app')

@section('heading','Purchase Create')

@section('button')
    <a href="{{ route('purchase_show') }}" class="btn btn-primary"><i class="fas fa-view"></i> View</a>
@endsection

@section('main_content')
<div class="section-body">
    <form action="{{ route('purchase_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label>Date*</label>
                            <input class="form-control @error('date') is-invalid @enderror  example-date-input" name="date" type="date" id="date" value="{{ old('date') }}">
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label>Purchase No*</label>
                            <input type="text" class="form-control @error('purchase_no') is-invalid @enderror example-date-input" name="purchase_no" id="purchase_no" value="{{ old('purchase_no') }}">
                            @error('purchase_no')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label>Product Name*</label>
                            <select id="product_id" name="product_id" class="form-control select2">
                                <option value="">Select Product</option>
                                @foreach ($product as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label>Supplier Name</label>
                            <input type="hidden" class="form-control" name="supplier_id" id="supplier_id" value="">
                            <input type="text" class="form-control" name="supplier_name" id="supplier_name" value="" readonly>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label>Category Name</label>
                            <input type="hidden" class="form-control" name="category_id" id="category_id" value="">
                            <input type="text" class="form-control" name="category_name" id="category_name" value="" readonly>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label style="margin-top:43px;"></label>            
                            <i class="btn btn-primary btn-rounded fas fa-plus-circle addeventmore"> Add More</i>
                        </div>
                    </div>
                </div>
                <!-- // end row  --> 
            </div><!-- End card-body -->
        </div><!-- End card -->
        <!--  ---------------------------------- -->
        <div class="card">
            <div class="card-body">
                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Product Name </th>
                            <th>PCS/KG</th>
                            <th>Unit Price </th>
                            <th>Description</th>
                            <th>Total Price</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
    
                    <tbody id="addRow" class="addRow">
                        
                    </tbody>
    
                    <tbody>
                        <tr>
                            <td colspan="5"></td>
                            <td>
                                <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                            </td>
                            <td></td>
                        </tr>
                    </tbody>                
                </table><br>
            </div> <!-- End card-body -->
        </div><!-- End card -->
        <div class="form-group">
            <button id="storeButton" type="submit" class="btn btn-primary">Purchase Store</button>
        </div>
    </form>
</div>
</section>

<script id="document-template" type="text/x-handlebars-template">
     
    <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]" value="@{{date}}">
            <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
            <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">

        <td>
            <input type="hidden" name="category_id[]" value="@{{category_id}}">
            @{{ category_name }}
        </td>
    
         <td>
            <input type="hidden" name="product_id[]" value="@{{product_id}}">
            @{{ product_name }}
        </td>
    
        <td>
            <input type="number" min="1" class="form-control buying_qty text-center" name="buying_qty[]" value="0"> 
        </td>
    
        <td>
            <input type="number" class="form-control unit_price text-center" name="unit_price[]" value="0"> 
        </td>
    
        <td>
            <input type="text" class="form-control" name="description[]"> 
        </td>
    
        <td>
            <input type="number" class="form-control buying_price text-center" name="buying_price[]" value="0" readonly> 
        </td>
    
        <td>
            <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
        </td>
    
    </tr>
    
</script>
    
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click",".addeventmore", function(){
            var date = $('#date').val();
            var purchase_no = $('#purchase_no').val();
            var supplier_id = $('#supplier_id').val();
            var category_id  = $('#category_id').val();
            var category_name = $('#category_name').val();
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find('option:selected').text();


            if(date == ''){
                $.notify("Date is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
                 }
                  if(purchase_no == ''){
                $.notify("Purchase No is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
                 }

                  if(supplier_id == ''){
                $.notify("Supplier is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
                 }
                  if(category_id == ''){
                $.notify("Category is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
                 }
                  if(product_id == ''){
                $.notify("Product Field is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
                 }


                 var source = $("#document-template").html();
                 var tamplate = Handlebars.compile(source);
                 var data = {
                    date:date,
                    purchase_no:purchase_no,
                    supplier_id:supplier_id,
                    category_id:category_id,
                    category_name:category_name,
                    product_id:product_id,
                    product_name:product_name

                 };
                 var html = tamplate(data);
                 $("#addRow").append(html); 
        });

        $(document).on("click",".removeeventmore",function(event){
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice();
        });

        $(document).on('keyup click','.unit_price,.buying_qty', function(){
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var qty = $(this).closest("tr").find("input.buying_qty").val();
            var total = unit_price * qty;
            $(this).closest("tr").find("input.buying_price").val(total);
            totalAmountPrice();
        });

        // Calculate sum of amout in invoice 

        function totalAmountPrice(){
            var sum = 0;
            $(".buying_price").each(function(){
                var value = $(this).val();
                if(!isNaN(value) && value.length != 0){
                    sum += parseFloat(value);
                }
            });
            $('#estimated_amount').val(sum);
        }  

    });


</script>

<script type="text/javascript">
    $(function(){
        $(document).on('change','#product_id',function(){
            var product_id = $(this).val();
            $.ajax({
                url:"{{ route('get-category') }}",
                type: "GET",
                data:{product_id:product_id},
                success:function(data){

                    $.each(data,function(key,v){
                        $('#category_id').val(v.id);
                        $('#category_name').val(v.category_name);
                    });
                }
            })
        });
    });

</script>


<script type="text/javascript">
    $(function(){
        $(document).on('change','#product_id',function(){
            var product_id = $(this).val();
            $.ajax({
                url:"{{ route('get-supplier') }}",
                type: "GET",
                data:{product_id:product_id},
                success:function(data){

                    $.each(data,function(key,v){
                        $('#supplier_id').val(v.id);
                        $('#supplier_name').val(v.name);

                    });
                }
            })
        });
    });

</script>

@endsection