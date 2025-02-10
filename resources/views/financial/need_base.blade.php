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
        </div><br><br>
        <h1 class="section-title">More Scholarships</h1><br>
                <div class="custom-vertical flow-up">
                    
                    <div class="why-choose-us-section" >
                        <h3 class="sub-title3">External Sponsorships</h3><br>
                        <div class="university-logos">
                            <img src="https://logolook.net/wp-content/uploads/2022/07/Petronas-Logo-2013.png" alt="University Logo 3">
                            <img src="https://www.khazanah.com.my/media/uploads/2020/06/Yayasan-Hasanah-Logo-1.png" alt="University Logo 4">
                            <img src="https://mdec.my/static/images/mdcap/resource-bnm-logo.png" alt="University Logo 4">
                            <img src="https://ik.imagekit.io/impian/kouk-foundation.jpg?updatedAt=1689601512471" alt="University Logo 4">
                        
                        </div><br>
                        <h3>Unlock financial support for your education through external sponsorships! Get funding for tuition fees, hostel accommodations, flights, and various grants from reputable organizations. Explore opportunities from top sponsors to ease your financial burden and focus on your studies.</h3>
                        <a class="cta-button mt-4" href="{{ url('/financial/external-sponsorship') }}">explore more</a>
                    </div>

                    <div class="why-choose-us-section" >
                        <h3 class="sub-title3">Study Loan</h3><br>
                        <img src="https://www.ptptn.gov.my/wp-content/uploads/2021/11/PTPTN-FA-Brandmark_Stacked-Original.png">
                        <br>
                        <h3>Need financial assistance for your studies? Access study loans to cover tuition fees, living expenses, and other education-related costs. Flexible repayment plans and government-backed options ensure you can focus on your academic journey without financial stress.</h3>
                        <a class="cta-button mt-4" href="{{ url('/financial/study-loan') }}">Explore More</a>
                    </div>
    </div>
</x-app-layout>
