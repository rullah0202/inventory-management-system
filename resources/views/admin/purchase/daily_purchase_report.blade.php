@extends('admin.layout.app')

@section('heading','Date Wise Purchase Report ')
@section('main_content')

<div class="section-body">
    <div class="card">
        <div class="card-body">
<div class="col-12">             
<form method="GET" action="{{ route('daily.purchase.pdf') }}" target="_blank" id="myForm">
    <div class="row">

      

        <div class="col-md-4">
            <div class="md-3 form-group">
                <label for="example-text-input" class="form-label">Start Date</label>
                 <input class="form-control example-date-input" name="start_date" type="date"  id="start_date" placeholder="YY-MM-DD">
            </div>
        </div>

         
        <div class="col-md-4">
            <div class="md-3 form-group">
                <label for="example-text-input" class="form-label">End Date</label>
                 <input class="form-control example-date-input" name="end_date" type="date"  id="end_date" placeholder="YY-MM-DD">
            </div>
        </div>

         <div class="col-md-4">
            <div class="md-3">
                <label for="example-text-input" class="form-label" style="margin-top:55px;"> </label>
             <button type="submit" class="btn btn-info">Search</button>
            </div>
        </div>
  


    </div> <!-- // end row  --> 

    </form>
           
        </div> <!-- End card-body -->
  


    </div>
</div> <!-- end col -->
</div>
 


</div>
</div>
 
 
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                start_date: {
                    required : true,
                }, 
                 end_date: {
                    required : true,
                },
                 
            },
            messages :{
                start_date: {
                    required : 'Please Select Start Date',
                },
                end_date: {
                    required : 'Please Select End Date',
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
