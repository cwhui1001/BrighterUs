@vite(['resources/css/admin/user.css', 'resources/js/admin/user.js'])

@extends('layouts.admin')

@section('content')
<div class="edit-user-container">
    <div class="edit-user-card">
        <h2>Edit User</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-input" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-input" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password">New Password (leave blank if not changing):</label>
                <input type="password" name="password" class="form-input">
            </div>

            <div class="button-group">
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection
