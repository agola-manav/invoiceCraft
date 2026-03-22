@extends('front.layouts.layout')

@section('content')

<style>
    .section-title {
        font-weight: 600;
        font-size: 14px;
        color: #0d6efd;
        border-left: 3px solid #0d6efd;
        padding-left: 10px;
        margin-bottom: 15px;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px 12px;
    }

    .card {
        border-radius: 12px;
    }

    .card-footer {
        position: sticky;
        bottom: 0;
        background: #fff;
        z-index: 10;
    }
</style>

<div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
        
        <!-- Header -->
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-semibold">Edit Company</h5>
        </div>

        <form method="POST" action="{{ route('companies.update', \App\Helpers\Helper::encryptor($company->id, 'encrypt')) }}" id="companyForm" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
            	@include('front.company._partials.form')
            </div>

            <!-- Footer -->
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary btn-md">Save</button>
                <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary btn-md">Cancel</a>
            </div>

        </form>
    </div>
</div>

@endsection

@section('custom-script')
<script>
$(document).ready(function () {

    $('#companyForm').ajaxForm({
    	beforeSubmit: function(arr, $form, options) {

            let name = $('input[name="name"]').val().trim();
            let mobile = $('input[name="phone_number"]').val().trim();
            let email = $('input[name="email"]').val().trim();
            let gst = $('input[name="gstn"]').val().trim();
            let accNo = $('input[name="ac_no"]').val().trim();
            let ifsc = $('input[name="isfc"]').val().trim();
            let upi = $('input[name="upi_id"]').val().trim();

            $('.is-invalid').removeClass('is-invalid');

            if (name === '') {
                toastr.error("Name is required");
                $('input[name="name"]').addClass('is-invalid').focus();
                return false;
            }

            if (!/^[0-9]{10}$/.test(mobile)) {
                toastr.error("Enter valid 10 digit phone number");
                $('input[name="phone_number"]').addClass('is-invalid').focus();
                return false;
            }

            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email === '') {
                toastr.error("Email is required");
                $('input[name="email"]').addClass('is-invalid').focus();
                return false;
            }

            if (!emailPattern.test(email)) {
                toastr.error("Enter valid email address");
                $('input[name="email"]').addClass('is-invalid').focus();
                return false;
            }

            let gstPattern = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
            if (gst !== '' && !gstPattern.test(gst)) {
                toastr.error("Enter valid GST number");
                $('input[name="gstn"]').addClass('is-invalid').focus();
                return false;
            }

            if (accNo !== '' && !/^[0-9]{9,18}$/.test(accNo)) {
                toastr.error("Enter valid account number (9–18 digits)");
                $('input[name="ac_no"]').addClass('is-invalid').focus();
                return false;
            }

            let ifscPattern = /^[A-Z]{4}0[A-Z0-9]{6}$/;
            if (ifsc !== '' && !ifscPattern.test(ifsc)) {
                toastr.error("Enter valid IFSC code");
                $('input[name="isfc"]').addClass('is-invalid').focus();
                return false;
            }

            let upiPattern = /^[\w.-]+@[\w.-]+$/;
            if (upi !== '' && !upiPattern.test(upi)) {
                toastr.error("Enter valid UPI ID (example@bank)");
                $('input[name="upi_id"]').addClass('is-invalid').focus();
                return false;
            }

            $('body').removeClass('loaded');

            return true;
        },
        success: function(response) {
        	$('body').addClass('loaded');

        	if(response.status == 'success') {
        		toastr.success(response.message);
        		window.location.href = "{{ route('companies.index') }}";
        	}
        },
        error: function(xhr) {
            $('button[type="submit"]').prop('disabled', false).text('Save');

            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;

                $.each(errors, function(key, value) {
                    toastr.error(value[0]);

                    // Highlight field
                    $('[name="' + key + '"]').addClass('is-invalid');
                });
            } else {
                toastr.error("Something went wrong");
            }
        }
    });

});
</script>
@endsection