
@vite(['resources/css/admin/financial.css', 'resources/js/admin/financial.js'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


@extends('layouts.admin')

@section('content')
<div class="admin-header-container">
    <h1>Financial Aid Management</h1>
</div>

<div class="py-12">
    @if (session('success'))
        <div id="success-alert" class="alert alert-success" style="z-index: 1050;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="error-alert" class="alert alert-danger " style="z-index: 1050;">
            {{ session('error') }}
        </div>
    @endif

        
    <a href="{{ route('admin.financial.scholarships.create') }}" class="btn btn-primary mb-3">Add Scholarship</a>

    <!-- Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.financial.scholarships') }}" method="GET">
                <div class="row">
                    <!-- Filter by Type -->
                    <div class="col-md-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">All Types</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by Scholarship Name -->
                    <div class="col-md-3">
                        <label for="value" class="form-label">Scholarship Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
                    </div>
                    <!-- Filter by Application Deadline -->
                    <div class="col-md-3">
                        <label for="deadline" class="form-label">Application Deadline</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" value="{{ request('deadline') }}">
                    </div>

                    

                    <!-- Submit Button -->
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                        <a href="{{ route('admin.financial.scholarships') }}" class="btn btn-secondary ms-2">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Scholarships Table -->
        <table class="financial-table table-bordered">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Participating Programmes</th>
                    <th>Eligibility Criteria</th>
                    <th>Scholarship Value</th>
                    <th>Documents Required</th>
                    <th>Application Procedure</th>
                    <th>Application Deadline</th>
                    <th>Terms & Conditions</th>
                    <th>Further Info</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scholarships as $scholarship)
                    <tr>
                        <td>
                            <a href="{{ route('admin.financial.scholarships.edit', $scholarship->id) }}" class="btn btn-warning btn-sm">Edit</a><br><br>
                            <form action="{{ route('admin.financial.scholarships.destroy', $scholarship->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete scholarship?')">Delete</button>
                            </form>
                        </td>
                        <td>{{ $scholarship->type }}</td>
                        <td>{{ $scholarship->name }}</td>
                        <td>{!! $scholarship->participating_programmes !!}</td>
                        <td>{!! $scholarship->eligibility_criteria !!}</td>
                        <td>{!! $scholarship->scholarship_value !!}</td>
                        <td>{!! $scholarship->documents_required !!}</td>
                        <td>{!! $scholarship->application_procedure !!}</td>

                        <td>{{ $scholarship->application_deadline }}</td>
                        <td>{!! $scholarship->terms_conditions ?? 'N/A' !!}</td>
                        <td>{!! $scholarship->further_info ?? 'N/A' !!}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($scholarships->isEmpty())
            <p class="text-center">No scholarships available.</p>
        @endif
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        function fadeOutAlert(alertId) {
            let alertBox = document.getElementById(alertId);
            if (alertBox) {
                setTimeout(function () {
                    alertBox.style.transition = "opacity 0.5s ease";
                    alertBox.style.opacity = "0";
                    setTimeout(function () {
                        alertBox.style.display = "none";
                    }, 500);
                }, 3000);
            }
        }

        // Auto-hide success and error messages
        fadeOutAlert("success-alert");
        fadeOutAlert("error-alert");
    });
</script>
@endsection
