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
        <h3 class="page-title mb-1">Teams</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Teams</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @include('include.messages')
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Team Members</h3>
                    <a class="btn btn-primary" href="{{ route('admin.teams.create') }}">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teams as $team)
                        <tr>
                            <td>
                                <span class="avatar avatar-lg me-2">
                                    <img src="{{ asset('storage/'.$team->img) }}" alt="{{ $team->name }}">
                                </span>
                            </td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->department }}</td>
                            <td>{{ $team->created_at->format('F d, Y') }}</td>
                            <td class="text-center">
                                <div class='btn-group'>
                                    <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-default btn-sm"><i class="fas fa-edit"></i></a>
                                    <form class="delete-team-form" action="{{ route('admin.teams.destroy', $team->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-default btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No team members found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($teams->total() > 2)
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $teams->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(".delete-team-form").on("submit", function (e) {
            e.preventDefault();
            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this team member?</p>`,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: `<i class="fa fa-trash"></i> Yes, delete it!`,
                cancelButtonText: `<i class="fa fa-times"></i> Cancel`,
                allowOutsideClick: false,
                customClass: { confirmButton: 'red-button' }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection
