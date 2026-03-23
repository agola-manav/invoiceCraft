@extends('front.layouts.layout')

@section('header')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Product</h4>
            <div class="page-title-right">
            </div>
        </div>
    </div>
</div>
<!-- end page title --> 
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('payment-mode.create') }}" class="btn btn-primary btn-sm float-end create-member">
                    <i class="uil uil-plus"></i> Add Product
                </a>
                <div class="table-responsive mt-4">
                    <!-- Table with stripped rows -->
                    <table class="table dt-responsive nowrap w-100" id="ProductTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>HSN Code</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection