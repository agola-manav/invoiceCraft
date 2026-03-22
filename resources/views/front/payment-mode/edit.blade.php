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
            <h5 class="mb-0 fw-semibold">Edit Payment Mode</h5>
        </div>

        <form method="POST" action="{{ route('payment-mode.update', \App\Helpers\Helper::encryptor($paymente->id, 'encrypt')) }}" id="paymentModeForm" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
            	@include('front.payment-mode._partials.form')
            </div>

            <!-- Footer -->
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary btn-md">Save</button>
                <a href="{{ route('payment-mode.index') }}" class="btn btn-outline-secondary btn-md">Cancel</a>
            </div>

        </form>
    </div>
</div>

@endsection

@section('custom-script')
<script>
$(document).ready(function () {

    $('#paymentModeForm').ajaxForm({
        beforeSubmit: function(arr, $form, options) {
            let name = $('input[name="name"]').val().trim();

            if (name === '') {
                toastr.error("Name is required");
                $('input[name="name"]').addClass('is-invalid').focus();
                return false;
            }

            $('body').removeClass('loaded');

            return true;
        },
        success: function(response) {
            $('body').addClass('loaded');

            if(response.status == 'success') {
                toastr.success(response.message);
                window.location.href = "{{ route('payment-mode.index') }}";
            }
        },
        error: function(xhr) {
            $('body').addClass('loaded');

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