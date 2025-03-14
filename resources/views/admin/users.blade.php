  
@vite(['resources/css/admin/user.css', 'resources/js/admin/user.js'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@extends('layouts.admin')

@section('content')
<div class="admin-header-container">
    <h1>User Management</h1>
</div>

<div class="py-12">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div> 
    @endif

     <!-- Filter Form -->
     <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="Filter by name">
                    </div>
                    <div class="col-md-4">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ request('email') }}" placeholder="Filter by email">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary ml-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add User Form -->
    <form action="{{ route('admin.users.add') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Add User</button>
    </form>

    <!-- User List -->
    <table class="user-table" border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <!-- Edit Button (Triggers Modal) -->
                    <button class="btn btn-primary edit-user-btn"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-email="{{ $user->email }}"
                            onclick="openEditModal(this)">
                        Edit
                    </button>

                    <!-- Delete Form -->
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="editUserId">

                    <div class="form-group">
                        <label for="editUserName">Name:</label>
                        <input type="text" name="name" id="editUserName" class="form-control" required>
                    </div><br>

                    <div class="form-group">
                        <label for="editUserEmail">Email:</label>
                        <input type="email" name="email" id="editUserEmail" class="form-control" required>
                    </div><br>

                    <div class="form-group">
                        <label for="editUserPassword">New Password (leave blank if not changing):</label>
                        <input type="password" name="password" id="editUserPassword" class="form-control">
                    </div><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div><br>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
