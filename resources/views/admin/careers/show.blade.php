@extends('admin.default')

@section('content')

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between mb-3">
    <div class="my-auto mb-2">
        <h3 class="page-title mb-1">Careers</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.careers.index') }}">Careers</a></li>
                <li class="breadcrumb-item active">Details</li>
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
                <h3 class="card-title">Application Details</h3>
            </div>

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Full Name</dt>
                    <dd class="col-sm-9">{{ $career->full_name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $career->email }}</dd>

                    <dt class="col-sm-3">Position</dt>
                    <dd class="col-sm-9">{{ $career->position }}</dd>

                    <dt class="col-sm-3">Education Level</dt>
                    <dd class="col-sm-9">{{ $career->education_level }}</dd>

                    <dt class="col-sm-3">Reason to Join</dt>
                    <dd class="col-sm-9">{{ $career->reason_to_join }}</dd>

                    <dt class="col-sm-3">Cover Letter</dt>
                    <dd class="col-sm-9">
                        @if($career->cover_letter)
                            <a href="{{ asset('storage/' . $career->cover_letter) }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-download"></i> Download Resume
                            </a>
                        @else
                            <span class="text-muted">No cover letter uploaded</span>
                        @endif
                    </dd>



                    <dt class="col-sm-3">Resume</dt>
                    <dd class="col-sm-9">
                        @if($career->resume)
                            <a href="{{ asset('storage/' . $career->resume) }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-download"></i> Download Resume
                            </a>
                        @else
                            <span class="text-muted">No resume uploaded</span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Agreed to Terms</dt>
                    <dd class="col-sm-9">{{ $career->is_agree ? 'Yes' : 'No' }}</dd>

                    <dt class="col-sm-3">Submitted At</dt>
                    <dd class="col-sm-9">{{ $career->created_at->format('d M, Y H:i:A') }}</dd>
                </dl>
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.careers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
