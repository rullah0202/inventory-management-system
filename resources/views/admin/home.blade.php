@extends('admin.layout.app')

@section('heading', 'Dashboard')

@section('main_content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fab fa-atlassian"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Category</h4>
                </div>
                <div class="card-body">
                    {{ $total_category }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fab fa-bandcamp"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Supplier</h4>
                </div>
                <div class="card-body">
                    {{ $total_supplier }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Product</h4>
                </div>
                <div class="card-body">
                    {{ $total_product }}
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-camera"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Photos</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-video"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Videos</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-question-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total FAQ</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>--}}
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-vote-yea"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Purchase</h4>
                </div>
                <div class="card-body">
                    {{ $total_purchase }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fab fa-google-drive"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Invoice</h4>
                </div>
                <div class="card-body">
                    {{ $total_invoice }}
                </div>
            </div>
        </div>
    </div> 
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Customers</h4>
                </div>
                <div class="card-body">
                    {{ $total_customer }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection