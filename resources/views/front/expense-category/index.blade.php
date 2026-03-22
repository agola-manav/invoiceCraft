@extends('front.layouts.layout')

@section('header')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Expense Category</h4>
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
                <a href="{{ route('expense-category.create') }}" class="btn btn-primary btn-sm float-end create-member">
                    <i class="uil uil-plus"></i> Add Expense Category
                </a>
                <h5 class="card-title mt-0 mb-0 header-title">List of Expense Category</h5>
                <div class="table-responsive mt-4">
                    <!-- Table with stripped rows -->
                    <table class="table dt-responsive nowrap w-100" id="expenseCategoryTable">
                        <thead>
                            <tr>
                                <th>Name</th>
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

@section('custom-script')
<script>
    var dataTable = $('#expenseCategoryTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('expense-category.list') }}",
        columns: [
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $(document).on('click', '.delete-expense-category', function () {

        let form = $(this).closest('form');
        let url = form.attr('action');

        Swal.fire({
            title: "Are you sure?",
            text: "This expense category will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {

            if (result.isConfirmed) {
                $('body').removeClass('loaded');
                $.ajax({
                    url: url,
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        $('body').addClass('loaded');

                        if(response.status == 'success') {
                            toastr.success(response.message)
                            dataTable.draw();
                        }
                    },
                    error: function () {
                        Swal.fire("Error!", "Something went wrong", "error");
                    }
                });

            }
        });

    });
</script>
@endsection