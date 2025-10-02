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

        .avatar-xxxl {
            width: 80px;
            height: 80px;
            object-fit: cover;
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
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">News</li>
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
                    <h3 class="card-title mb-0">News</h3>
                    <a class="btn btn-primary" href="{{ route('admin.news.create') }}">
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
                            <th>Type</th>
                            <th>Featured</th>
                            <th>Social Links</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                        <tr>
                            <td>
                                @if($item->img)
                                    <img src="{{ asset('storage/'.$item->img) }}" 
                                         alt="{{ $item->title }}" 
                                         class="avatar-xxxl rounded">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{!! $item->title !!}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($item->type) ?? '-' }}</span>
                            </td>
                            <td>
                                @if($item->is_featured)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    @if($item->youtube_url)
                                        <a href="{{ $item->youtube_url }}" target="_blank"><i class="fab fa-youtube text-danger"></i></a>
                                    @endif
                                    @if($item->twitter_url)
                                        <a href="{{ $item->twitter_url }}" target="_blank"><i class="fab fa-twitter text-info"></i></a>
                                    @endif
                                    @if($item->facebook_url)
                                        <a href="{{ $item->facebook_url }}" target="_blank"><i class="fab fa-facebook text-primary"></i></a>
                                    @endif
                                    @if($item->linkdin_url)
                                        <a href="{{ $item->linkdin_url }}" target="_blank"><i class="fab fa-linkedin text-primary"></i></a>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $item->created_at->format('F d, Y') }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-default btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="delete-news-form" action="{{ route('admin.news.destroy', $item->id) }}" method="POST">
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
                    </tbody>
                </table>
            </div>
            @if($news->total() > 2)
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $news->links('vendor.pagination.bootstrap-4') }}
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
        $(".delete-news-form").on("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this news?</p>`,
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
