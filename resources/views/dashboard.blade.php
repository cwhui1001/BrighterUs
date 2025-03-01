@vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
<x-app-layout>
    <x-slot name="header" class="dash-header relative bg-orange-400">
        <div class="container">
            <div class="starry-background">
                <h2 class="dashboard-header">
                    <svg width="90%" height="30%">
                        <text x="50%" y="60%"  text-anchor="middle"  >
                            BrighterUs
                        </text>
                    </svg>
                </h2>
                <div class="title-content animate-title" id="line1">Every step you take today shapes the path to a brighter and more fulfilling tomorrow.</div>
                <div class="title-content animate-title" id="line2">At BrighterUs, we believe that each small action builds the foundation for a future full of endless possibilities.</div><br>
            </div>
            <div class="circle-frame bounce-animation">
                <img src="{{ asset('images/tertiaryeducation.jpg') }}" alt="Circular Image">
            </div>
        </div>
        
        <!-- Add the wavy bottom -->
        <div class="wavy-bottom">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 230">
                <path id="wave" fill="#ffffff" fill-opacity="1" d="M0,224L80,202.7C160,181,320,139,480,144C640,149,800,203,960,208C1120,213,1280,171,1360,149.3L1440,128L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
            </svg>
        </div>
    </x-slot>
<br>
    <div class="py-12">
        <div class="max-w-[90rem] mx-auto sm:px-10 lg:px-16">
            <div class="custom-text flow-up">
                <h2 class="sub-title">{{ __('Finding the Right Options Too Slow and Painful?') }}</h2>
                <div class="sub-title">
                    <img src="{{ asset('images/confuse.png') }}">
                </div>
                <div class="sub-title">
                    <img src="{{ asset('images/confuseWords.png') }}">
                </div>
            </div>

            <div class="custom flow-up">
                <img src="{{ asset('images/free.png') }}">
            </div>
        
            <h1 class="section-title">Why Choose Us?</h1><br>
            <div id="why-choose-us-container" class="custom-vertical flow-up">
                <!-- Dynamic content will be inserted here -->
            </div>
            <script>
                
            </script>
            <br>
            <div class="faq-container flow-up">
                <div class="faq-con mx-auto p-6 shadow">
                    <h1 class="text-2xl font-bold text-center mb-6">Frequently Asked Questions</h1>

                    <div class="space-y-4">
                        @foreach ($faqs as $faq)
                        <div class="border border-gray-300 rounded-lg">
                            <!-- Button to toggle FAQ -->
                            <button
                                class="w-full flex justify-between items-center px-4 py-3 font-semibold text-left faq-toggle"
                                onclick="toggleFaq(this)"
                            >
                                <span class="faq-question">{{ $faq->question }}</span> <!-- Question Text -->
                                <span class="faq-icon text-xl">+</span> <!-- Toggle Icon -->
                            </button>

                            <!-- Answer Content -->
                            <div class="faq-content hidden px-4 py-2 text-gray-600">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.appUrls = {
            courses: "{{ url('/courses') }}",
            needBased: "{{ url('/financial/need-based') }}",
            events: "{{ url('/events') }}",
            career: "{{ url('/career') }}"
        };
        window.appImages = {
            event1: "{{ asset('images/event1.jpg') }}",
            mbti: "{{ asset('images/mbti.png') }}"
        };
    </script>
    <script src="{{ asset('js/why-choose-us.js') }}" defer></script>


</x-app-layout>
