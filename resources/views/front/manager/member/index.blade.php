@extends('front.manager.layouts.layout')

@section('header')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Member</h4>
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
                <h5 class="card-title mt-0 mb-0 header-title">List of Members</h5>
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

@section('custom-script')
<script type="text/javascript">
    $( function () {
        var dataTable = $('#member-table').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ route('member.list') }}",
            columns: [
                {data:'name',name:'name', 'orderable': false, 'searchable': true, width:"10%"},
                {data:'email',name:'email','orderable':false,'searchable':true, width:"10%"},
                {data:'phone',name:'phone','orderable':false,'searchable':true, width:"10%"},
                {data:'is_status',name:'is_status','orderable':false,'searchable':true, width:"10%"},
                {data:'created_at',name:'created_at','orderable':false,'searchable':false, width:"10%"},
                {data: 'action', name: 'action', 'orderable': false, 'searchable': false, width:"10%"},
            ],
            "language": {
                "paginate": {
                    "previous": "<i class='uil uil-angle-left'>",
                    "next": "<i class='uil uil-angle-right'>"
                }
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });


        $(document).on('click', '.create-member', function() {
            $("body").removeClass("loaded");
            $.ajax({
                type: 'GET',
                url: "{{ route('member.create') }}",
                data: {},
                success: function(response) {
                    $("body").addClass("loaded");
                    $.showModal({title: "Create Member", body: response,modalDialogClass:'modal-md'});
                    $('#phone').mask('(999) 999-9999');
                }
            });
        });

        $(document).on('click', '.edit-member', function() {
            $("body").removeClass("loaded");
            var member_id = $(this).attr('data-id');

            $.ajax({
                type: 'GET',
                url: "{{ route('member.edit', 'memberId') }}".replace('memberId', member_id),
                data: {},
                success: function(response) {
                    $("body").addClass("loaded");
                    $.showModal({title: "Edit Member", body: response,modalDialogClass:'modal-md'});
                    $('#phone').mask('(999) 999-9999');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal', function () {
            $('#memberForm').ajaxForm({
               beforeSubmit: function (arr, $form, options)
               {

                    if ($('#name').val().trim() === '') {
                        toastr.error('Please enter name.');
                        $('#name').focus();
                        return false;
                    }

                    if ($('#email').val().trim() === '') {
                        toastr.error('Please enter email.');
                        $('#email').focus();
                        return false;
                    }

                    if ($('#phone').val().trim() === '') {
                        toastr.error('Please enter number.');
                        $('#phone').focus();
                        return false;
                    }

                    if ($("#password").length && $("#password").attr("required")) {
                        var password = $('#password').val().trim();

                        if (password === '') {
                            toastr.error('Please enter password.');
                            $('#password').focus();
                            return false;
                        }

                        var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/;
                        if (!regex.test(password)) {
                            toastr.error('Password must be at least 8 characters long, include a capital letter, a number, and a special character.');
                            $('#password').focus();
                            return false;
                        }
                    }

                    $("body").removeClass("loaded");
                },

                success: function (data) {
                    $("body").addClass("loaded");
                    $('.modal').modal('hide');
                    toastr.success(data.message);
                    dataTable.draw();
                },
                error: function (xhr) {
                    $("body").addClass("loaded");
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Something went wrong.');
                    }
                }
            });
        });


        $(document).on('click', '.btn-delete', function() {
            var form = $(this).closest('form');
            var id = form.find('input[name="id"]').val();

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to delete this member?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5369f8",
                cancelButtonColor: "#d33",
                focusConfirm: false,
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: form.attr('action'),
                        data: {_token: form.find('input[name="_token"]').val()},
                        success: function(response) {
                            toastr.success(response.message);
                            dataTable.draw();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection