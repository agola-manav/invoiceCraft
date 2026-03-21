@extends('front.layouts.layout')

@section('header')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Company</h4>
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
                <a href="#" class="btn btn-primary btn-sm float-end create-member">
                    <i class="uil uil-plus"></i>
                </a>
                <h5 class="card-title mt-0 mb-0 header-title">List of Companies</h5>
                <div class="table-responsive mt-4">
                    <!-- Table with stripped rows -->
                    <table class="table dt-responsive nowrap w-100" id="member-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
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