@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1>
        Welcome {{ $user->is_admin ? 'Admin' : 'User' }}, {{ $user->name }}!
    </h1>

    <p class="mt-4">
        You are logged in as <strong>{{ $user->email }}</strong>
    </p>

    @if ($user->is_admin)
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">Go to Admin Dashboard</a>
    @else
    <a href="{{ route('dashboard') }}" class="btn btn-success mt-3">Go to User Dashboard</a>
    @endif
</div>
@endsection