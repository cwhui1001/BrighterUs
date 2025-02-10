
@vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
<x-app-layout>
    <x-slot name="header" class="dash-header relative bg-orange-400">
        <div class="container">
            <div class="starry-background">
                <h2 class="dashboard-header">
                    <div class="title animate-title">{{ __('BrighterUs') }}</div><br>
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
                <div class="custom-vertical flow-up">
                    <div class="why-choose-us-section" >
                        <h2 class="sub-title3">Explore Top Universities All Over Malaysia!</h2><br>
                        <div class="university-logos">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Sunway_logo.jpg/1200px-Sunway_logo.jpg" alt="University Logo 1">
                            <img src="https://jmeducationgroup.com/wp-content/uploads/2021/03/Taylors-University-Logo.jpeg" alt="University Logo 2">
                            <img src="https://d30mzt1bxg5llt.cloudfront.net/public/uploads/images/_signatoryLogo/2016-MonashUniversityMALAYSIA_2-MonoCMYKoutlines.jpg" alt="University Logo 3">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQR8y9ZDsvA9NHsWgJQbo7g9C97_XgzkS8bww&s" alt="University Logo 4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/29/Multimedia_University_secondary_logo_2020.png" alt="University Logo 4">
                            <img src="https://erasmusplusfriends.eu/wp-content/uploads/2019/05/APU-Logo_Final_Vertical_V1_HR1-copy-1024x966.png" alt="University Logo 4">
                        </div><br>
                        <h3>Compare Universities by price, ranking, location just by your finger tips!</h3>
                        <a class="cta-button mt-4" href="{{ url('/universities') }}">See All Universities</a>

                    </div>
                    <div class="why-choose-us-section" >
                        <h3 class="sub-title3">Grab Chances of Getting Full Scholarships!</h3><br>
                        <div class="university-logos">
                            <img src="https://sunway.edu.my/sites/default/files/inline-images/jcf-logo%402x.png" alt="University Logo 1">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNOwxmmuX1D6LAWoX7ZU_AgDXtVHG5kn4Yhy-cUhQ-tlCrxAwWGS4LBKGeociHGgtdaBE&usqp=CAU" alt="University Logo 2">
                            <img src="https://logolook.net/wp-content/uploads/2022/07/Petronas-Logo-2013.png" alt="University Logo 3">
                            <img src="https://www.khazanah.com.my/media/uploads/2020/06/Yayasan-Hasanah-Logo-1.png" alt="University Logo 4">
                            <img src="https://mdec.my/static/images/mdcap/resource-bnm-logo.png" alt="University Logo 4">
                            <img src="https://ik.imagekit.io/impian/kouk-foundation.jpg?updatedAt=1689601512471" alt="University Logo 4">
                        </div><br>
                        <h3>Get scholarships and sponsorships on tuition fees, hostels, flights, and many more grants!</h3>
                        <a class="cta-button mt-4" href="{{ url('/financial') }}">See All Scholarships</a>
                    </div>

                    <div class="why-choose-us-section" >
                        <h3 class="sub-title3">Get Updated with Upcoming Education Fair!</h3><br>
                        <img src="{{ asset('images/event1.jpg') }}">
                        <br>
                        <h3>Get notified with all the upcoming education fairs in Malaysia!</h3>
                        <a class="cta-button mt-4" href="{{ url('/events') }}">Explore All Events</a>
                    </div>

                    <div class="why-choose-us-section">
                        <h3 class="sub-title3">Get Personalized Career Advice!</h3><br>
                        <img src="{{ asset('images/mbti.png') }}">                        <br>
                        <h3>Get personalized pathway advice by going through a quick career assessment!</h3>
                        <a class="cta-button mt-4" href="{{ url('/career') }}">Take a career test</a>
                    </div>
                    
                </div>


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
    function toggleFaq(button) {
        const content = button.nextElementSibling; // Get the content div
        const isHidden = content.classList.contains('hidden');

        // Close all FAQ contents first
        document.querySelectorAll('.faq-content').forEach((faq) => faq.classList.add('hidden'));
        document.querySelectorAll('.faq-toggle .faq-icon').forEach((icon) => (icon.textContent = '+'));

        // Toggle the current FAQ
        if (isHidden) {
            content.classList.remove('hidden'); // Show the content
            button.querySelector('.faq-icon').textContent = '×'; // Change the icon to ×
        } else {
            content.classList.add('hidden'); // Hide the content
            button.querySelector('.faq-icon').textContent = '+'; // Change the icon back to +
        }
    }
</script>
    
</x-app-layout>
