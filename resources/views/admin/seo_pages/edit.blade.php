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
        <h3 class="page-title mb-1">Edit SEO Page</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.seo_pages.index') }}">SEO Pages</a></li>
                <li class="breadcrumb-item active">Edit SEO Page</li>
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
                <h3 class="card-title">Edit SEO Page</h3>
            </div>

            <form action="{{ route('admin.seo_pages.update', [$seoPage->id]) }}" method="POST" id="editSeoPage">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">

                        <!-- Page -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="page_id">Page</label>
                                <select name="page_id" id="page_id" class="form-control">
                                    <option value="">-- Select Page --</option>
                                    @foreach($pages as $page)
                                        <option value="{{ $page->id }}" {{ old('page_id', $seoPage->page_id) == $page->id ? 'selected' : '' }}>
                                            {{ $page->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title', $seoPage->title) }}" placeholder="Enter title">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="description">Description</label>
                                <textarea id="description" name="description">{{ old('description', $seoPage->description) }}</textarea>
                            </div>
                            <label class="error" for="description"></label>
                        </div>

                        <!-- Indexing -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="indexing">Indexing</label>
                                <select name="indexing" id="indexing" class="form-control">
                                    <option value="">-- Select Indexing --</option>
                                    <option value="follow_index" {{ old('indexing', $seoPage->indexing) == 'follow_index' ? 'selected' : '' }}>follow,index</option>
                                    <option value="nofollow_noindex" {{ old('indexing', $seoPage->indexing) == 'nofollow_noindex' ? 'selected' : '' }}>nofollow,noindex</option>
                                </select>
                            </div>
                        </div>

                        <!-- Canonical -->
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="canonical">Canonical URL</label>
                                <input type="url" class="form-control" name="canonical" id="canonical"
                                    value="{{ old('canonical', $seoPage->canonical) }}" placeholder="http://">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                    <a href="{{ route('admin.seo_pages.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function() {
    $("#editSeoPage").validate({
        rules: {
            page_id: { required: true },
            title: { required: true, minlength: 3 },
            description: { required: true, minlength: 20 },
            indexing: { required: true },
            canonical: { url: true }
        },
        messages: {
            page_id: { required: "Please select a page" },
            title: { required: "Please enter a title" },
            description: { required: "Please enter description" },
            indexing: { required: "Please select indexing option" },
            canonical: { url: "Please enter a valid URL" }
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
            form.submit();
        }
    });

    $('#description').summernote({
        height: 200,
        placeholder: 'Enter description',
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
