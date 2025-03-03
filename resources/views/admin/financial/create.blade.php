@extends('layouts.admin')

@section('content')
    <h2 style="background-color: orange; padding: 20px; color: white; border-radius: 15px">Add Scholarship</h2>


    <form style="padding: 20px;" action="{{ route('admin.financial.scholarships.store') }}" method="POST">
        @csrf
        <label>Type:</label>
        <input type="text" name="type" class="form-control" required><br>

        <label>Participating Programmes:</label>
        <input type="text" name="participating_programmes" class="form-control" required><br>

        <label>Eligibility Criteria:</label>
        <input type="text" name="eligibility_criteria" class="form-control" required><br>

        <label>Scholarship Value:</label>
        <input type="text" name="scholarship_value" class="form-control" required><br>

        <label>Documents Required:</label>
        <textarea name="documents_required" class="form-control"></textarea><br>

        <label>Application Procedure:</label>
        <textarea name="application_procedure" class="form-control"></textarea><br>

        <label>Application Deadline:</label>
        <input type="date" name="application_deadline" class="form-control" required><br>

        <button type="submit" class="btn btn-success">Submit</button><br>
    </form>
@endsection
