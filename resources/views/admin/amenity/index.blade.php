@extends('admin.default')

@section('css')
    <style>
        .table td {
            white-space: unset;
        }

        .swal2-confirm.red-button {
            background-color: red !important;
            border-color: red !important;
            color: white !important;
        }
    </style>
@endsection

@section('content')
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between mb-3">
    <div class="my-auto mb-2">
        <h3 class="page-title mb-1">Amenities</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Amenities</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        @include('include.messages')
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Amenities</h3>
                    <a class="btn btn-primary" href="{{ route('admin.amenity.create') }}">
                        <i class="fas fa-solid fa-plus"></i>
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Project</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($amenities as $amenity)
                        <tr>
                            <td>
                                @if($amenity->img)
                                    <span class="avatar avatar-xxxl me-2">
                                        <img src="{{ asset('storage/'.$amenity->img) }}" alt="{{ $amenity->title }}">
                                    </span>
                                @endif
                            </td>
                            <td>{{ $amenity->title }}</td>
                            <td>{{ $amenity->project->title ?? 'N/A' }}</td>
                            <td>{{ $amenity->created_at->format('F d, Y') }}</td>
                            <td class="text-center">
                                <div class='btn-group'>
                                    <a href="{{ route('admin.amenity.edit', $amenity->id) }}" class="btn btn-default btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="delete-amenity-form" action="{{ route('admin.amenity.destroy', $amenity->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-default btn-sm">
                                            <i class="fas fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if($amenities->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No amenities found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @if($amenities->total() > 2)
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $amenities->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            @endif
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(".delete-amenity-form").on("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this amenity?</p>`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: `<i class="fa fa-trash"></i> Yes, delete it!`,
                confirmButtonAriaLabel: "Confirm deletion",
                cancelButtonText: `<i class="fa fa-times"></i> Cancel`,
                cancelButtonAriaLabel: "Cancel deletion",
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'red-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection
