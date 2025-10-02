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

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between mb-3">
    <div class="my-auto mb-2">
        <h3 class="page-title mb-1">News</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">News</a></li>
                <li class="breadcrumb-item active">Add News</li>
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
                <h3 class="card-title">Add News</h3>
            </div>

            <form action="{{ route('admin.news.store') }}" method="POST" id="addNews" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <!-- Title -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{ old('title') }}">
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="type">Type</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="">-- Select Type --</option>
                                    <option value="events" {{ old('type') == 'events' ? 'selected' : '' }}>Events</option>
                                    <option value="launches" {{ old('type') == 'launches' ? 'selected' : '' }}>Launches</option>
                                </select>
                            </div>
                        </div>

                        <!-- Featured -->
                        <div class="col-md-3 mb-3">
                            <div class="form-group form-check">
                                <input type="checkbox" 
                                    class="form-check-input" 
                                    name="is_featured" 
                                    id="is_featured" 
                                    value="1"
                                    {{ old('is_featured') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured</label>
                            </div>
                        </div>


                        <!-- Main Description -->
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="description">Description</label>
                                <textarea id="description" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- Main Image -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="img">Main Image</label>
                            <input type="file" class="form-control" name="img" id="img">
                            <img src="" style="max-width:100%; height:200px; display:none;">
                        </div>

                        <!-- Paragraph One -->
                        <div class="col-md-12 mt-3 mb-3"><h5>Paragraph One</h5></div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="paragraph_one_title">Title</label>
                            <input type="text" class="form-control" name="paragraph_one_title" id="paragraph_one_title" value="{{ old('paragraph_one_title') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="paragraph_one_img">Image</label>
                            <input type="file" class="form-control" name="paragraph_one_img" id="paragraph_one_img">
                            <img src="" style="max-width:100%; height:200px; display:none;">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="paragraph_one_description">Description</label>
                            <textarea id="paragraph_one_description" name="paragraph_one_description">{{ old('paragraph_one_description') }}</textarea>
                        </div>

                        <!-- Paragraph Two -->
                        <div class="col-md-12 mt-3 mb-3"><h5>Paragraph Two</h5></div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="paragraph_two_title">Title</label>
                            <input type="text" class="form-control" name="paragraph_two_title" id="paragraph_two_title" value="{{ old('paragraph_two_title') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="paragraph_two_img">Image</label>
                            <input type="file" class="form-control" name="paragraph_two_img" id="paragraph_two_img">
                            <img src="" style="max-width:100%; height:200px; display:none;">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="paragraph_two_description">Description</label>
                            <textarea id="paragraph_two_description" name="paragraph_two_description">{{ old('paragraph_two_description') }}</textarea>
                        </div>

                        <!-- Paragraph Three -->
                        <div class="col-md-12 mt-3 mb-3"><h5>Paragraph Three</h5></div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="paragraph_three_title">Title</label>
                            <input type="text" class="form-control" name="paragraph_three_title" id="paragraph_three_title" value="{{ old('paragraph_three_title') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="paragraph_three_img">Image</label>
                            <input type="file" class="form-control" name="paragraph_three_img" id="paragraph_three_img">
                            <img src="" style="max-width:100%; height:200px; display:none;">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="paragraph_three_description">Description</label>
                            <textarea id="paragraph_three_description" name="paragraph_three_description">{{ old('paragraph_three_description') }}</textarea>
                        </div>

                        <!-- Social Links -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="youtube_url">YouTube</label>
                            <input type="url" class="form-control" name="youtube_url" id="youtube_url" value="{{ old('youtube_url') }}" placeholder="http://">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="twitter_url">Twitter</label>
                            <input type="url" class="form-control" name="twitter_url" id="twitter_url" value="{{ old('twitter_url') }}" placeholder="http://">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="facebook_url">Facebook</label>
                            <input type="url" class="form-control" name="facebook_url" id="facebook_url" value="{{ old('facebook_url') }}" placeholder="http://">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="linkdin_url">LinkedIn</label>
                            <input type="url" class="form-control" name="linkdin_url" id="linkdin_url" value="{{ old('linkdin_url') }}" placeholder="http://">
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
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
        if (!value) return true;
        var extension = value.split('.').pop().toLowerCase();
        return $.inArray(extension, allowedExtensions) !== -1;
    }, 'Invalid file type');

    $("#addNews").validate({
        rules: {
            title: { required: true, minlength: 3 },
            type: { required: true },
            description: { required: true, minlength: 20 },
            img: { required: true, extension: ['jpg', 'jpeg', 'png'] },
            youtube_url: { url: true },
            twitter_url: { url: true },
            facebook_url: { url: true },
            linkdin_url: { url: true }
        },
        messages: {
            title: { required: "Please enter a title" },
            type: { required: "Please select a type" },
            description: { required: "Please enter description (min 20 chars)" },
            img: { required: 'Please upload a main image', extension: 'Only jpg, jpeg, png allowed' }
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
            $('#description').val($('#description').summernote('code'));
            $('#paragraph_one_description').val($('#paragraph_one_description').summernote('code'));
            $('#paragraph_two_description').val($('#paragraph_two_description').summernote('code'));
            $('#paragraph_three_description').val($('#paragraph_three_description').summernote('code'));
            form.submit();
        }
    });

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

    $('#description, #paragraph_one_description, #paragraph_two_description, #paragraph_three_description').summernote({
        height: 200,
        placeholder: 'Enter text...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']]
        ]
    });

});
</script>
@endsection
