@extends('admin.default')

@section('content')

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between mb-3">
    <div class="my-auto mb-2">
        <h3 class="page-title mb-1">Contacts</h3>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contacts</a></li>
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
                <h3 class="card-title">Contact Details</h3>
            </div>

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Full Name</dt>
                    <dd class="col-sm-9">{{ $contact->full_name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $contact->email }}</dd>

                    <dt class="col-sm-3">Reason to Join</dt>
                    <dd class="col-sm-9">{{ $contact->inquiry_about }}</dd>

                    <dt class="col-sm-3">Submitted At</dt>
                    <dd class="col-sm-9">{{ $contact->created_at->format('d M, Y H:i:A') }}</dd>
                </dl>
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
