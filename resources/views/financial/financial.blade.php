@vite(['resources/css/financial.css', 'resources/js/financial.js'])

<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Financial Aid') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="custom-text">
                {{ __("Learn more about scholarships, grants, and other financial aid options to support your education.") }}
            </div>
        </div>
    </div>
    
    
</div>
</x-app-layout>


<!-- <p>Learn more about scholarships, grants, and other financial aid options to support your education.</p>
    <div class="container mt-5">
    <h1 class="mb-4">Financial Scholarships</h1><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type</th>
                <th>Participating Programmes</th>
                <th>Eligibility Criteria</th>
                <th>Scholarship Value</th>
                <th>Documents Required</th>
                <th>Application Procedure</th>
                <th>Application Deadline</th>
                <th>Terms & Conditions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scholarships as $scholarship)
                <tr>
                    <td>{{ $scholarship->type }}</td>
                    <td>{{ $scholarship->participating_programmes }}</td>
                    <td>{{ $scholarship->eligibility_criteria }}</td>
                    <td>{{ $scholarship->scholarship_value }}</td>
                    <td>{{ $scholarship->documents_required }}</td>
                    <td>{{ $scholarship->application_procedure }}</td>
                    <td>{{ $scholarship->application_deadline }}</td>
                    <td>{{ $scholarship->terms_conditions }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> -->