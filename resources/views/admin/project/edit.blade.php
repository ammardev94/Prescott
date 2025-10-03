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
        <h3 class="page-title mb-1">Project</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.project.index') }}">Projects</a></li>
                <li class="breadcrumb-item active">Edit Project</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        @include('include.messages')


        <form action="{{ route('admin.project.update', $project->id) }}" method="POST" id="editProject" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Basic Info -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Basic Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title', $project->title) }}" placeholder="Enter title">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" name="location" id="location" class="form-control"
                                value="{{ old('location', $project->location) }}" placeholder="Enter location">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="ongoing" {{ old('status', $project->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Media</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="thumbnail_img" class="form-label">Thumbnail Image</label>
                            <input type="file" name="thumbnail_img" id="thumbnail_img" class="form-control">

                            @if($project->thumbnail_img)
                                <img src="{{ asset('storage/'.$project->thumbnail_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="video_thumbnail_img" class="form-label">Video Thumbnail Image</label>
                            <input type="file" name="video_thumbnail_img" id="video_thumbnail_img" class="form-control">
                            
                            @if($project->video_thumbnail_img)
                                <img src="{{ asset('storage/'.$project->video_thumbnail_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="video" class="form-label">Video File</label>
                            <input type="file" name="video" id="video" class="form-control">

                            @if($project->video)
                                <video id="video-preview-existing" controls style="max-width:100%; height:200px; margin-top:8px;">
                                    <source src="{{ asset('storage/'.$project->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="reception_img" class="form-label">Reception Image</label>
                            <input type="file" name="reception_img" id="reception_img" class="form-control">
                            
                            @if($project->reception_img)
                                <img src="{{ asset('storage/'.$project->reception_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="interior_img" class="form-label">Interior Image</label>
                            <input type="file" name="interior_img" id="interior_img" class="form-control">

                            @if($project->interior_img)
                                <img src="{{ asset('storage/'.$project->interior_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="exterior_img" class="form-label">Exterior Image</label>
                            <input type="file" name="exterior_img" id="exterior_img" class="form-control">

                            @if($project->exterior_img)
                                <img src="{{ asset('storage/'.$project->exterior_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="section_one_img" class="form-label">Section One Image</label>
                            <input type="file" name="section_one_img" id="section_one_img" class="form-control">

                            @if($project->section_one_img)
                                <img src="{{ asset('storage/'.$project->section_one_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="section_two_img" class="form-label">Section Two Image</label>
                            <input type="file" name="section_two_img" id="section_two_img" class="form-control">

                            @if($project->section_two_img)
                                <img src="{{ asset('storage/'.$project->section_two_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="section_three_img" class="form-label">Section Three Image</label>
                            <input type="file" name="section_three_img" id="section_three_img" class="form-control">

                            @if($project->section_three_img)
                                <img src="{{ asset('storage/'.$project->section_three_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="brochure" class="form-label">Brochure</label>
                            <input type="file" name="brochure" id="brochure" class="form-control">

                            @if($project->brochure)
                                <embed src="{{ asset('storage/'.$project->brochure) }}" type="application/pdf" 
                                    style="width:100%; height:200px; margin-top:8px;" />
                            @endif
                        </div>


                        <div class="col-md-4 mb-3">
                            <label for="amenities_brochure" class="form-label">Amenities Brochure</label>
                            <input type="file" name="amenities_brochure" id="amenities_brochure" class="form-control">

                            @if($project->amenities_brochure)
                                <embed src="{{ asset('storage/'.$project->amenities_brochure) }}" type="application/pdf" 
                                    style="width:100%; height:200px; margin-top:8px;" />
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <!-- Overview -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Overview</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label for="overview" class="form-label">Overview</label>
                            <textarea name="overview" id="overview" class="form-control summernote">{{ old('overview', $project->overview) }}</textarea>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="total_area" class="form-label">Total Area</label>
                            <input type="text" name="total_area" id="total_area" class="form-control" value="{{ old('total_area', $project->total_area) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="open_space" class="form-label">Open Space</label>
                            <input type="text" name="open_space" id="open_space" class="form-control" value="{{ old('open_space', $project->open_space) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="polo_field_n_stable_expanse" class="form-label">Polo Field And Stable Expanse</label>
                            <input type="text" name="polo_field_n_stable_expanse" id="polo_field_n_stable_expanse" class="form-control" value="{{ old('polo_field_n_stable_expanse', $project->polo_field_n_stable_expanse) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="clubhouse_gfa" class="form-label">Clubhouse GFA</label>
                            <input type="text" name="clubhouse_gfa" id="clubhouse_gfa" class="form-control" value="{{ old('clubhouse_gfa', $project->clubhouse_gfa) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="mix_use_gfa" class="form-label">Mix Use GFA</label>
                            <input type="text" name="mix_use_gfa" id="mix_use_gfa" class="form-control" value="{{ old('mix_use_gfa', $project->mix_use_gfa) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="residential_cluster" class="form-label">Residential Cluster</label>
                            <input type="text" name="residential_cluster" id="residential_cluster" class="form-control" value="{{ old('residential_cluster', $project->residential_cluster) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="resident_population" class="form-label">Resident Population</label>
                            <input type="text" name="resident_population" id="resident_population" class="form-control" value="{{ old('resident_population', $project->resident_population) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="residences" class="form-label">Residences</label>
                            <input type="text" name="residences" id="residences" class="form-control" value="{{ old('residences', $project->residences) }}">
                        </div>

                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Location</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label for="location_overview" class="form-label">Location Overview</label>
                            <textarea name="location_overview" id="location_overview" class="form-control summernote">{{ old('location_overview', $project->location_overview) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="location_map_url" class="form-label">Location Map URL</label>
                            <input type="url" name="location_map_url" id="location_map_url" class="form-control" value="{{ old('location_map_url', $project->location_map_url) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="map_iframe" class="form-label">Embedded Map (iframe)</label>
                            <textarea name="map_iframe" id="map_iframe" class="form-control" rows="3">{{ old('map_iframe', $project->map_iframe) }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Nearby Entertainment -->
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Nearby Entertainment</h3>
                    <button type="button" class="btn btn-primary btn-sm float-right" onclick="addKeyValue('entertainment')">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="card-body" id="entertainment-container">
                    @if(!empty($project->near_by_entertainment))
                        @foreach($project->near_by_entertainment as $i => $ent)
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <input type="text" name="near_by_entertainment[{{ $i }}][key]" 
                                        class="form-control" 
                                        value="{{ $ent['key'] ?? '' }}" 
                                        placeholder="Ex. 15 minutes">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="near_by_entertainment[{{ $i }}][value]" 
                                        class="form-control" 
                                        value="{{ $ent['value'] ?? '' }}" 
                                        placeholder="Ex. Dubai International Marine Club">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger" onclick="this.closest('.row').remove()">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Nearby Schools -->
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Nearby Schools</h3>
                    <button type="button" class="btn btn-primary btn-sm float-right" onclick="addKeyValue('schools')">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="card-body" id="schools-container">
                    @if(!empty($project->near_by_schools))
                        @foreach($project->near_by_schools as $i => $school)
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <input type="text" name="near_by_schools[{{ $i }}][key]" 
                                        class="form-control" 
                                        value="{{ $school['key'] ?? '' }}" 
                                        placeholder="Ex. 5 minutes">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="near_by_schools[{{ $i }}][value]" 
                                        class="form-control" 
                                        value="{{ $school['value'] ?? '' }}" 
                                        placeholder="Ex. Dubai International School">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger" onclick="this.closest('.row').remove()">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Nearby Clinics -->
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Nearby Clinics</h3>
                    <button type="button" class="btn btn-primary btn-sm float-right" onclick="addKeyValue('clinics')">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="card-body" id="clinics-container">
                    @if(!empty($project->near_by_clinics))
                        @foreach($project->near_by_clinics as $i => $clinic)
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <input type="text" name="near_by_clinics[{{ $i }}][key]" 
                                        class="form-control" 
                                        value="{{ $clinic['key'] ?? '' }}" 
                                        placeholder="Ex. 10 minutes">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="near_by_clinics[{{ $i }}][value]" 
                                        class="form-control" 
                                        value="{{ $clinic['value'] ?? '' }}" 
                                        placeholder="Ex. Emirates Hospital">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger" onclick="this.closest('.row').remove()">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Trademark Interiors -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Trademark Interiors</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trademark_interior_img" class="form-label">Interior Image</label>
                            <input type="file" name="trademark_interior_img" id="trademark_interior_img" class="form-control">

                            @if($project->trademark_interior_img)
                                <img src="{{ asset('storage/'.$project->trademark_interior_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="trademark_interior_brochure" class="form-label">Trademark Interior Brochure</label>
                            <input type="file" name="trademark_interior_brochure" id="trademark_interior_brochure" class="form-control">

                            @if($project->trademark_interior_brochure)
                                <embed src="{{ asset('storage/'.$project->trademark_interior_brochure) }}" type="application/pdf" 
                                    style="width:100%; height:200px; margin-top:8px;" />
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="trademark_interior_description" class="form-label">Interior Description</label>
                            <textarea name="trademark_interior_description" id="trademark_interior_description" class="form-control summernote">{{ old('trademark_interior_description', $project->trademark_interior_description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Construction Updates -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Construction Update</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="construction_update_img" class="form-label">Update Image</label>
                            <input type="file" name="construction_update_img" id="construction_update_img" class="form-control">

                            @if($project->construction_update_img)
                                <img src="{{ asset('storage/'.$project->construction_update_img) }}" style="max-width:100%; height:200px; margin-top:8px;">
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="construction_update_date" class="form-label">Update Date</label>
                            <input 
                                type="date" 
                                name="construction_update_date" 
                                id="construction_update_date" 
                                class="form-control"
                                value="{{ old('construction_update_date', $project->construction_update_date ? \Carbon\Carbon::parse($project->construction_update_date)?->format('Y-m-d') : '') }}">
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="construction_plan" class="form-label">Construction Plan (PDF)</label>
                            <input type="file" name="construction_plan" id="construction_plan" class="form-control">
                            
                            @if($project->construction_plan)
                                <embed src="{{ asset('storage/'.$project->construction_plan) }}" type="application/pdf" 
                                    style="width:100%; height:200px; margin-top:8px;" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="card card-primary">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                    <a href="{{ route('admin.project.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    // file extension validator
    $.validator.addMethod('extension', function (value, element, allowedExtensions) {
        if (!value) return true; // allow empty (use 'required' rule to enforce)
        var extension = value.split('.').pop().toLowerCase();
        return $.inArray(extension, allowedExtensions) !== -1;
    }, 'Invalid file type');

    // Google Maps embed iframe validator (validates iframe embed from google maps)
    $.validator.addMethod('googleMapEmbed', function (value, element) {
        if ($.trim(value) === '') return true; // allow empty
        var regex = /^<iframe.*src="https:\/\/www\.google\.com\/maps\/embed\?.*<\/iframe>$/i;
        return regex.test(value.trim());
    }, 'Please enter a valid Google Maps embed iframe.');

    // Google Maps URL validator (supports common google maps URL formats)
    $.validator.addMethod('googleMapUrl', function (value, element) {
        if ($.trim(value) === '') return true; // allow empty
        var regex = /^(https:\/\/maps\.app\.goo\.gl\/[A-Za-z0-9]+|https:\/\/goo\.gl\/maps\/[A-Za-z0-9]+|https:\/\/www\.google\.com\/maps\/.+)$/i;
        return regex.test(value.trim());
    }, 'Please enter a valid Google Maps URL.');

    // Initialize Summernote editors
    $('.summernote').summernote({
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']]
        ]
    });


    // --- Custom validator to ensure at least one row exists ---
    $.validator.addMethod("requireOneRow", function(value, element, params) {
        const container = $("#" + params + "-container");
        return container.find("input").length > 0; // At least one input exists
    }, "Please add at least one item.");

    // --- Custom validator to ensure key/value fields are not empty ---
    $.validator.addMethod("notEmptyField", function(value, element) {
        return $.trim(value).length > 0;
    }, "This field is required.");

    // Form validation
    $("#addProject").validate({
        rules: {
            title: { required: true, minlength: 3 },
            status: { required: true },

            video: { required: false, extension: ['mp4', 'avi', 'mpeg', 'quicktime'] },

            thumbnail_img: { required: false, extension: ['jpg', 'jpeg', 'png', 'webp'] },
            video_thumbnail_img: { extension: ['jpg', 'jpeg', 'png', 'webp'] },
            trademark_interior_img: { extension: ['jpg', 'jpeg', 'png', 'webp'] },
            construction_update_img: { extension: ['jpg', 'jpeg', 'png', 'webp'] },

            brochure: { extension: ['pdf'] },
            amenities_brochure: { extension: ['pdf'] },
            trademark_interior_brochure: { extension: ['pdf'] },
            construction_plan: { extension: ['pdf'] },

            location_map_url: { googleMapUrl: true },
            map_iframe: { googleMapEmbed: true },

            total_area: { maxlength: 255 },
            open_space: { maxlength: 255 },

            "near_by_entertainment": { requireOneRow: "entertainment" },
            "near_by_schools": { requireOneRow: "schools" },
            "near_by_clinics": { requireOneRow: "clinics" }
        },
        messages: {
            title: { required: "Please enter the project title", minlength: "Title must be at least 3 characters" },
            status: { required: "Please select project status" },

            thumbnail_img: { required: "Please upload a thumbnail image", extension: "Only jpg, jpeg, png, webp allowed" },
            video_thumbnail_img: { extension: "Only jpg, jpeg, png, webp allowed" },
            trademark_interior_img: { extension: "Only jpg, jpeg, png, webp allowed" },
            construction_update_img: { extension: "Only jpg, jpeg, png, webp allowed" },

            brochure: { extension: "Only PDF allowed" },
            trademark_interior_brochure: { extension: "Only PDF allowed" },
            construction_plan: { extension: "Only PDF allowed" },

            location_map_url: { googleMapUrl: "Please enter a valid Google Maps URL" },
            map_iframe: { googleMapEmbed: "Please enter a valid Google Maps embed iframe" }
        },
        errorElement: "label",
        validClass: "is-valid",
        errorClass: "is-invalid text-danger",
        errorPlacement: function(error, element) {
            if (element.attr("name").startsWith("near_by_entertainment")) {
                error.insertAfter("#entertainment-container");
            } else if (element.attr("name").startsWith("near_by_schools")) {
                error.insertAfter("#schools-container");
            } else if (element.attr("name").startsWith("near_by_clinics")) {
                error.insertAfter("#clinics-container");
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
        },
        submitHandler: function(form) {
            $('.summernote').each(function(){
                var $el = $(this);
                $el.val($el.summernote('code'));
            });
            form.submit();
        }
    });

    // Thumbnail preview
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

    $('input[type="file"]').on('change', function() {
        var input = $(this);
        var file = input[0].files[0];

        if (file) {
            var fileType = file.type;

            var reader = new FileReader();
            reader.onload = function(e) {

                input.siblings('img, embed, video').remove();

                if (fileType.startsWith('image/')) {
                    var img = $('<img>').css({
                        'max-width': '100%',
                        'height': '200px',
                        'display': 'block',
                        'margin-top': '8px'
                    });
                    input.after(img);
                    img.attr('src', e.target.result).show();
                }
                else if (fileType === 'application/pdf') {
                    var pdf = $('<embed>').attr({
                        type: 'application/pdf',
                        width: '100%',
                        height: '400px'
                    }).css({
                        'display': 'block',
                        'margin-top': '8px'
                    });
                    input.after(pdf);
                    pdf.attr('src', e.target.result).show();
                }
                else if (fileType.startsWith('video/')) {
                    var video = $('<video controls>').css({
                        'max-width': '100%',
                        'height': '300px',
                        'display': 'block',
                        'margin-top': '8px'
                    });
                    input.after(video);
                    video.attr('src', e.target.result).show();
                }
            };
            reader.readAsDataURL(file);
        }
    });

});
</script>

<script>
function addKeyValue(section) {
    const container = document.getElementById(section + '-container');

    const index = container.querySelectorAll('.row').length;

    const row = document.createElement('div');
    row.classList.add('row', 'mb-2');

    row.innerHTML = `
        <div class="col-md-5">
            <input type="text" name="near_by_${section}[${index}][key]" class="form-control" placeholder="Ex. 15 minutes">
        </div>
        <div class="col-md-5">
            <input type="text" name="near_by_${section}[${index}][value]" class="form-control" placeholder="Ex. Dubai International Marine Club">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger" onclick="this.closest('.row').remove()"><i class="fa fa-trash"></i></button>
        </div>
    `;

    container.appendChild(row);
}
</script>
@endsection
