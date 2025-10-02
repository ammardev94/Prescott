@extends('admin.default')

@section('css')
<style>
    .error {
        color: red;
        font-size: 0.875em;
    }
    .is-invalid {
        border-color: #dc3545;
    }
    .is-valid {
        border-color: #28a745;
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
    }
    .note-editor.note-frame .note-editing-area .note-editable {
        height: 200px !important;
    }
</style>
@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between mb-3">
    <div class="my-auto mb-2">
        <h3 class="page-title mb-1">SEO Scripts</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">SEO Script</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @include('include.messages')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit SEO Script</h3>
            </div>

            <form action="{{ route('admin.seo-scripts.update', [$seoScript->id]) }}" method="POST" id="editSeoScript">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="header">Header Script</label>
                            <textarea class="form-control" rows="6" id="header" name="header">{{ old('header', $seoScript->header) }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="body">Body Script</label>
                            <textarea class="form-control" rows="6" id="body" name="body">{{ old('body', $seoScript->body) }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="footer">Footer Script</label>
                            <textarea class="form-control" rows="6" id="footer" name="footer">{{ old('footer', $seoScript->footer) }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(function(){

    $("#editSeoScript").validate({
        rules: {
            header: { required: false, minlength: 5 },
            body: { required: false, minlength: 5 },
            footer: { required: false, minlength: 5 }
        },
        messages: {
            header: {
                required: "Please enter the header script",
                minlength: "Header script must be at least 5 characters long"
            },
            body: {
                required: "Please enter the body script",
                minlength: "Body script must be at least 5 characters long"
            },
            footer: {
                required: "Please enter the footer script",
                minlength: "Footer script must be at least 5 characters long"
            }
        },
        errorElement: "label",
        validClass: "is-valid",
        errorClass: "is-invalid text-danger",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection
