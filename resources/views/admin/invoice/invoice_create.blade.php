@extends('admin.layout.app')

@section('heading','Invoice Create')

@section('button')
    <a href="{{ route('invoice_show') }}" class="btn btn-primary"><i class="fas fa-view"></i> View</a>
@endsection

@section('main_content')
<div class="section-body">
    <form action="{{ route('invoice_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label>Invoice No</label>
                            <input type="text" class="form-control example-date-input" name="invoice_no" id="invoice_no" value="{{ $invoice_no }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label>Date*</label>
                            <input class="form-control @error('date') is-invalid @enderror  example-date-input" name="date" type="date" id="date" value="{{ $date }}">
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label>Product Name*</label>
                            <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror select2">
                                <option value="">Select Product</option>
                                @foreach ($product as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                        @error('product_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label>Stock(Pcs/Kg)</label>
                            <input type="text" class="form-control" name="current_stock_qty" id="current_stock_qty" value="" readonly>
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
                            <th width="10%">PSC/KG</th>
                            <th width="10%">Unit Price </th> 
                            <th width="15%">Total Price</th>
                            <th width="10%">Action</th> 
    
                        </tr>
                    </thead>
    
                    <tbody id="addRow" class="addRow">
                        
                    </tbody>
    
                    <tbody>
            <tr>
                <td colspan="4"> Discount</td>
                <td>
                <input type="text" name="discount_amount" id="discount_amount" class="form-control estimated_amount text-center" placeholder="Discount Amount"  >
                </td>
            </tr>
    
    
                        <tr>
                            <td colspan="4"> Grand Total</td>
                            <td>
                                <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                            </td>
                            <td></td>
                        </tr>
    
                    </tbody>                
                </table><br>
    
    
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea name="description" class="form-control" id="description" placeholder="Write Description Here" style="height: 50px"></textarea>
                    </div>
                </div><br>
    
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label> Paid Status </label>
                            <select name="paid_status" id="paid_status" class="form-control @error('paid_status') is-invalid @enderror">
                                <option value="">Select Status </option>
                                <option value="full_paid">Full Paid </option>
                                <option value="full_due">Full Due </option>
                                 <option value="partial_paid">Partial Paid </option>
                                
                            </select>
                            @error('paid_status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display:none;">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-1">
                            <label> Customer Name  </label>
                            <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror select2">
                                <option value="">Select Customer </option>
                                @foreach($costomer as $cust)
                                <option value="{{ $cust->id }}">{{ $cust->name }} - {{ $cust->mobile_no }}</option>
                                @endforeach
                                 <option value="0">New Customer </option>
                            </select>
                        </div>
                        @error('customer_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div> <!-- // end row --> <br>
    
    <!-- Hide Add Customer Form -->
    <div class="row new_customer" style="display:none">
        <div class="form-group col-md-4">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Write Customer Name">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group col-md-4">
            <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Write Customer Mobile No">
        </div>
    
        <div class="form-group col-md-4">
            <input type="email" name="email" id="email" class="form-control" placeholder="Write Customer Email">
        </div>
    </div>
    <!-- End Hide Add Customer Form -->
    
     <br>
    
            </div> <!-- End card-body -->
        </div><!-- End card -->
        <div class="form-group">
            <button id="storeButton" type="submit" class="btn btn-primary">Invoice Store</button>
        </div>
    </form>
</div>
</section>

<script id="document-template" type="text/x-handlebars-template">
     
    <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date" value="@{{date}}">
            <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
            
       
        <td>
            <input type="hidden" name="category_id[]" value="@{{category_id}}">
            @{{ category_name}}
        </td>
    
         <td>
            <input type="hidden" name="product_id[]" value="@{{product_id}}">
            @{{ product_name }}
        </td>
    
         <td>
            <input type="number" min="1" class="form-control selling_qty text-center" name="selling_qty[]" value=""> 
        </td>
    
        <td>
            <input type="number" class="form-control unit_price text-center" name="unit_price[]" value=""> 
        </td>
    
      
    
         <td>
            <input type="number" class="form-control selling_price text-center" name="selling_price[]" value="0" readonly> 
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
                var invoice_no = $('#invoice_no').val(); 
                var category_id  = $('#category_id').val();
                var category_name = $('#category_name').val();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();
    
    
                if(date == ''){
                    $.notify("Date is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                      
                    //   if(category_id == ''){
                    // $.notify("Category is Required" ,  {globalPosition: 'top right', className:'error' });
                    // return false;
                    //  }
                      if(product_id == ''){
                    $.notify("Product Field is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }

                     if(current_stock_qty == '0'){
                    $.notify("There is no Stock" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
    
    
                     var source = $("#document-template").html();
                     var tamplate = Handlebars.compile(source);
                     var data = {
                        date:date,
                        invoice_no:invoice_no, 
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
    
            $(document).on('keyup click','.unit_price,.selling_qty', function(){
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.selling_qty").val();
                var total = unit_price * qty;
                $(this).closest("tr").find("input.selling_price").val(total);
                $('#discount_amount').trigger('keyup');
            });
    
            $(document).on('keyup','#discount_amount',function(){
                totalAmountPrice();
            });
    
            // Calculate sum of amout in invoice 
    
            function totalAmountPrice(){
                var sum = 0;
                $(".selling_price").each(function(){
                    var value = $(this).val();
                    if(!isNaN(value) && value.length != 0){
                        sum += parseFloat(value);
                    }
                });
    
                var discount_amount = parseFloat($('#discount_amount').val());
                if(!isNaN(discount_amount) && discount_amount.length != 0){
                        sum -= parseFloat(discount_amount);
                    }
    
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
                url:"{{ route('check-product-stock') }}",
                type: "GET",
                data:{product_id:product_id},
                success:function(data){                   
                    $('#current_stock_qty').val(data);
                }
            });
        });
    });

</script>

<script type="text/javascript">
    $(document).on('change','#paid_status', function(){
        var paid_status = $(this).val();
        if (paid_status == 'partial_paid') {
            $('.paid_amount').show();
        }else{
            $('.paid_amount').hide();
        }
    });

      $(document).on('change','#customer_id', function(){
        var customer_id = $(this).val();
        if (customer_id == '0') {
            $('.new_customer').show();
        }else{
            $('.new_customer').hide();
        }
    });


</script>



@endsection