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
        <h3 class="page-title mb-1">Portfolio</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.portfolio.index') }}">Portfolio</a></li>
                <li class="breadcrumb-item active">Edit Portfolio</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        @include('include.messages')
        <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" id="editPortfolio" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Portfolio</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        {{-- General Fields --}}
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" 
                                value="{{ old('title', $portfolio->title) }}" placeholder="Enter title">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" name="location" id="location" class="form-control" 
                                value="{{ old('location', $portfolio->location) }}" placeholder="Enter location">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="client" class="form-label">Client</label>
                            <input type="text" name="client" id="client" class="form-control" 
                                value="{{ old('client', $portfolio->client) }}" placeholder="Enter client name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="value" class="form-label">Value</label>
                            <input type="text" name="value" id="value" class="form-control" 
                                value="{{ old('value', $portfolio->value) }}" placeholder="Enter project value">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="consortium" class="form-label">Consortium</label>
                            <input type="text" name="consortium" id="consortium" class="form-control" 
                                value="{{ old('consortium', $portfolio->consortium) }}" placeholder="Enter consortium">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanama_role" class="form-label">Tanama Role</label>
                            <input type="text" name="tanama_role" id="tanama_role" class="form-control" 
                                value="{{ old('tanama_role', $portfolio->tanama_role) }}" placeholder="Enter Tanama role">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="builder" class="form-label">Builder</label>
                            <input type="text" name="builder" id="builder" class="form-control" 
                                value="{{ old('builder', $portfolio->builder) }}" placeholder="Enter builder name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="architect" class="form-label">Architect</label>
                            <input type="text" name="architect" id="architect" class="form-control" 
                                value="{{ old('architect', $portfolio->architect) }}" placeholder="Enter architect name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="financial_close_date" class="form-label">Financial Close Date</label>
                            <input type="text" name="financial_close_date" id="financial_close_date" class="form-control" 
                                value="{{ old('financial_close_date', $portfolio->financial_close_date) }}" placeholder="e.g. May 2018">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="completion_date" class="form-label">Completion Date</label>
                            <input type="text" name="completion_date" id="completion_date" class="form-control" 
                                value="{{ old('completion_date', $portfolio->completion_date) }}" placeholder="e.g. September 2020">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contract_terms" class="form-label">Contract Terms</label>
                            <input type="text" name="contract_terms" id="contract_terms" class="form-control" 
                                value="{{ old('contract_terms', $portfolio->contract_terms) }}" placeholder="Enter contract terms">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="awards" class="form-label">Awards</label>
                            <input type="text" name="awards" id="awards" class="form-control" 
                                value="{{ old('awards', $portfolio->awards) }}" placeholder="Enter awards">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="map_url" class="form-label">Map URL</label>
                            <input type="url" name="map_url" id="map_url" class="form-control" 
                                value="{{ old('map_url', $portfolio->map_url) }}" placeholder="http://">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="map" class="form-label">Embedded Map (iframe HTML)</label>
                            <textarea name="map" id="map" class="form-control" rows="3">{{ old('map', $portfolio->map) }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="other_information" class="form-label">Other Information</label>
                            <textarea name="other_information" id="other_information" class="form-control" rows="3">{{ old('other_information', $portfolio->other_information) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="in-progress" {{ $portfolio->status == 'in-progress' ? 'selected': '' }}>In Progress</option>
                                <option value="completed" {{ $portfolio->status == 'completed' ? 'selected': '' }}>Completed</option>
                            </select>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="col-md-6 mb-3">
                            <label for="thumbnail_img" class="form-label">Thumbnail Image</label>
                            <input type="file" name="thumbnail_img" id="thumbnail_img" class="form-control">
                            @if($portfolio->thumbnail_img)
                                <img src="{{ asset('storage/'. $portfolio->thumbnail_img) }}" alt="Thumbnail" 
                                    style="max-width: 100%; height: 200px;">
                            @endif
                        </div>

                        {{-- Gallery --}}
                        <div class="col-md-6 mb-3">
                            <label for="images" class="form-label">Gallery Images (Multiple)</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                            <div id="preview-images" class="mt-2">
                                @if(!empty($portfolio->images))
                                    @foreach($portfolio->images as $img)
                                        <img src="{{ asset('storage/'. $img) }}" 
                                            style="max-width: 100px; height: 100px; margin: 5px;">
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section One --}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Section One</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="section_one_title" class="form-label">Section One Title</label>
                            <input type="text" name="section_one_title" id="section_one_title" class="form-control" 
                                value="{{ old('section_one_title', $portfolio->section_one_title) }}" placeholder="Enter section one title">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="section_one_paragraph" class="form-label">Section One Paragraph</label>
                            <textarea name="section_one_paragraph" id="section_one_paragraph" rows="4" 
                                    class="form-control" placeholder="Enter section one paragraph">{{ old('section_one_paragraph', $portfolio->section_one_paragraph) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="section_one_button_text" class="form-label">Section One Button Text</label>
                            <input type="text" name="section_one_button_text" id="section_one_button_text" class="form-control" 
                                value="{{ old('section_one_button_text', $portfolio->section_one_button_text) }}" placeholder="Enter button text">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="section_one_button_file" class="form-label">Section One Button File</label>
                            <input type="file" name="section_one_button_file" id="section_one_button_file" class="form-control">
                            @if($portfolio->section_one_button_file)
                                <a href="{{ asset('storage/'. $portfolio->section_one_button_file) }}" target="_blank" class="d-block mt-2">
                                    View File
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section Four --}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Section Four</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="section_four_title" class="form-label">Section Four Title</label>
                            <input type="text" name="section_four_title" id="section_four_title" class="form-control" 
                                value="{{ old('section_four_title', $portfolio->section_four_title) }}" placeholder="Enter section four title">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="section_four_paragraph" class="form-label">Section Four Paragraph</label>
                            <textarea name="section_four_paragraph" id="section_four_paragraph" rows="4" class="form-control" 
                                    placeholder="Enter section four paragraph">{{ old('section_four_paragraph', $portfolio->section_four_paragraph) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="section_four_button_text" class="form-label">Section Four Button Text</label>
                            <input type="text" name="section_four_button_text" id="section_four_button_text" class="form-control" 
                                value="{{ old('section_four_button_text', $portfolio->section_four_button_text) }}" placeholder="Enter button text">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="section_four_button_link" class="form-label">Section Four Button Link</label>
                            <input type="url" name="section_four_button_link" id="section_four_button_link" class="form-control" 
                                value="{{ old('section_four_button_link', $portfolio->section_four_button_link) }}" placeholder="https://">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                    <a href="{{ route('admin.portfolio.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    $.validator.addMethod('extension', function (value, element, allowedExtensions) {
        if (!value) return true; // allow empty in edit
        var extension = value.split('.').pop().toLowerCase();
        return $.inArray(extension, allowedExtensions) !== -1;
    }, 'Invalid file type');

    $.validator.addMethod('googleMapEmbed', function (value, element) {
        if ($.trim(value) === '') return false;
        var regex = /^<iframe.*src="https:\/\/www\.google\.com\/maps\/embed\?.*<\/iframe>$/i;
        return regex.test(value.trim());
    }, 'Please enter a valid Google Maps embed iframe.');

    $.validator.addMethod('googleMapUrl', function (value, element) {
        if ($.trim(value) === '') return false;
        var regex = /^(https:\/\/maps\.app\.goo\.gl\/[A-Za-z0-9]+|https:\/\/goo\.gl\/maps\/[A-Za-z0-9]+|https:\/\/www\.google\.com\/maps\/.+)$/i;
        return regex.test(value.trim());
    }, 'Please enter a valid Google Maps URL.');

    $("#editPortfolio").validate({
        rules: {
            thumbnail_img: { extension: ['jpg', 'jpeg', 'png', 'webp'] },
            'images[]': { extension: ['jpg', 'jpeg', 'png', 'webp'] },
            title: { required: true },
            location: { required: true },
            map: { required: true, googleMapEmbed: true },
            map_url: { required: true, googleMapUrl: true },
            client: { required: true },
            value: { required: true },
            consortium: { required: true },
            tanama_role: { required: true },
            builder: { required: true },
            architect: { required: true },
            financial_close_date: { required: true },
            completion_date: { required: true },
            contract_terms: { required: true },
            awards: { required: true },
            other_information: { required: true },
            section_one_title: { required: true },
            section_one_paragraph: { required: true },
            section_one_button_text: { required: true },
            section_one_button_file: { extension: ['pdf','doc','docx'] },
            section_four_title: { required: true },
            section_four_paragraph: { required: true },
            section_four_button_text: { required: true },
            section_four_button_link: { url: true }
        },
        messages: {
            thumbnail_img: { extension: "Only jpg, jpeg, png, webp allowed" },
            'images[]': { extension: "Only jpg, jpeg, png, webp allowed" },
            title: { required: "Please enter title" },
            location: { required: "Please enter location" },
            map: { required: "Please enter embedded map HTML" },
            map_url: { required: "Please enter Google map URL" },
            client: { required: "Please enter client name" },
            value: { required: "Please enter value" },
            consortium: { required: "Please enter consortium" },
            tanama_role: { required: "Please enter Tanama role" },
            builder: { required: "Please enter builder name" },
            architect: { required: "Please enter architect name" },
            financial_close_date: { required: "Please enter financial close date" },
            completion_date: { required: "Please enter completion date" },
            contract_terms: { required: "Please enter contract terms" },
            awards: { required: "Please enter awards" },
            other_information: { required: "Please enter other information" },
            section_one_title: { required: "Please enter section one title" },
            section_one_paragraph: { required: "Please enter section one paragraph" },
            section_one_button_text: { required: "Please enter button text" },
            section_one_button_file: { extension: "Only PDF/DOC allowed" },
            section_four_title: { required: "Please enter section four title" },
            section_four_paragraph: { required: "Please enter section four paragraph" },
            section_four_button_text: { required: "Please enter button text" },
            section_four_button_link: { url: "Please enter a valid URL" }
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

    $('#thumbnail_img').on('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#thumbnail_img').siblings('img').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });

    $('#images').on('change', function() {
        $('#preview-images').empty();
        Array.from(this.files).forEach(file => {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-images').append('<img src="'+e.target.result+'" style="max-width: 100px; height: 100px; margin: 5px;">');
            };
            reader.readAsDataURL(file);
        });
    });

    $('#section_one_paragraph').summernote({
        height: 200,
        placeholder: 'Enter section one paragraph',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']]
        ]
    });

    $('#section_four_paragraph').summernote({
        height: 200,
        placeholder: 'Enter section four paragraph',
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
