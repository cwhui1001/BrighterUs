@vite(['resources/css/financial.css', 'resources/js/financial.js'])

<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Need-Based Scholarship') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="custom-text-financial">
                {{ __("Offered to “budding potentials” from the age of 18-25, recommended from children welfare homes, NGOs or poor communities.") }}
            </div>
        </div>
        <div class="scholar_container max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Left Section -->
            <div class="left-section">
                <br>
                @foreach($scholarships as $scholarship)
                    <button class="scholarship" onclick="showDetails('scholarship{{ $scholarship->id }}')">
                        {!! $scholarship->name !!}
                    </button>
                @endforeach
            </div>

            <!-- Right Section -->
            <div class="right-section">
                @foreach($scholarships as $scholarship)
                    <div id="scholarship{{ $scholarship->id }}" class="details" style="display: none;">
                        <div class="dropdown-container">
                            <!-- Conditionally Display -->
                            @if (!empty($scholarship->participating_programmes))
                                <div class="dropdown">
                                    <button class="dropdown-btn">Participating Programme</button>
                                    <div class="dropdown-content">
                                        {!! $scholarship->participating_programmes !!}
                                    </div>
                                </div>
                            @endif
                            @if (!empty($scholarship->eligibility_criteria))
                                <div class="dropdown">
                                    <button class="dropdown-btn">Eligibility Criteria</button>
                                    <div class="dropdown-content">
                                        {!! $scholarship->eligibility_criteria !!}
                                    </div>
                                </div>
                            @endif
                            @if (!empty($scholarship->scholarship_value))
                                <div class="dropdown">
                                    <button class="dropdown-btn">Scholarship Value</button>
                                    <div class="dropdown-content">
                                        {!! $scholarship->scholarship_value !!}
                                    </div>
                                </div>
                            @endif

                            @if (!empty($scholarship->documents_required))
                                <div class="dropdown">
                                    <button class="dropdown-btn">Documents Required</button>
                                    <div class="dropdown-content">
                                        {!! $scholarship->documents_required !!}
                                    </div>
                                </div>
                            @endif
                            @if (!empty($scholarship->application_procedure))
                                <div class="dropdown">
                                    <button class="dropdown-btn">Application Procedure</button>
                                    <div class="dropdown-content">
                                        {!! $scholarship->application_procedure !!}
                                    </div>
                                </div>
                            @endif
                            @if (!empty($scholarship->application_deadline))
                                <div class="dropdown">
                                    <button class="dropdown-btn">Application Deadline</button>
                                    <div class="dropdown-content">
                                        {!! $scholarship->application_deadline !!}
                                    </div>
                                </div>
                            @endif
                            @if (!empty($scholarship->terms_conditions))
                                <div class="dropdown">
                                    <button class="dropdown-btn">Terms & Conditions</button>
                                    <div class="dropdown-content">
                                        {!! $scholarship->terms_conditions !!}
                                    </div>
                                </div>
                            @endif
                            @if (!empty($scholarship->further_info))
                                <div class="dropdown">
                                    <button class="dropdown-btn">Further Information</button>
                                    <div class="dropdown-content">
                                        {!! $scholarship->further_info !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
