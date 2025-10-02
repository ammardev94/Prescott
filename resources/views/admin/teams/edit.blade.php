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
</style>
@endsection

@section('content')

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between mb-3">
    <div class="my-auto mb-2">
        <h3 class="page-title mb-1">Teams</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.teams.index') }}">Teams</a></li>
                <li class="breadcrumb-item active">Edit Team</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        @include('include.messages')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Team</h3>
            </div>

            <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" id="editTeam" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                                       value="{{ old('name', $team->name) }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="department">Department</label>
                                <input type="text" class="form-control" name="department" id="department" placeholder="Enter department"
                                       value="{{ old('department', $team->department) }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="img">Main Image</label>
                            <input type="file" name="img" id="img" class="form-control" accept="image/*">
                            <input type="hidden" id="existingImage" value="{{ $team->img }}">
                            @if($team->img)
                                <img src="{{ asset('storage/'.$team->img) }}" style="max-width:100%; height:150px;" alt="Team Image">
                            @endif
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function() {

    $.validator.addMethod('extension', function (value, element, allowedExtensions) {
        var extension = value.split('.').pop().toLowerCase();
        return $.inArray(extension, allowedExtensions) !== -1;
    }, 'Invalid file type');

    $("#editTeam").validate({
        rules: {
            name: { required: true, minlength: 3 },
            department: { required: true, minlength: 2 },
            img: { 
                required: function() {
                    return $('#existingImage').val();
                },
                filesize: 20971520,
                extension: ['jpg', 'jpeg', 'png'] 
            },


        },
        messages: {
            name: { required: "Please enter a name" },
            department: { required: "Please enter department" },
            img: { extension: 'Only jpg, jpeg, png, webp allowed', filesize: 'Image must be less than 20MB' }
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

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than 20MB');

    $('input[type="file"]').on('change', function() {
        var input = $(this);
        var file = input[0].files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                input.siblings('img').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });

});
</script>
@endsection
