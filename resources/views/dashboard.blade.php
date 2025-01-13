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
            <div class="circle-frame animate-title">
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
                <div class="custom-text">
                    <h2 class="sub-title">{{ __('Finding the Right Options Too Slow and Painful?') }}</h2>
                    <div class="sub-title">
                        <img src="{{ asset('images/confuse.png') }}">
                    </div>
                    <div class="sub-title">
                        <img src="{{ asset('images/confuseWords.png') }}">
                    </div>
                </div>
                <div class="custom">
                    <img src="{{ asset('images/free.png') }}">
                </div>

                
        </div>
    </div>
<script>
   
    // Wavy bottom
    const wavePath = document.getElementById('wave');
    let wavePhase = 0;

    function animateWave() {
        wavePhase += 0.04; // Controls wave speed
        const waveAmplitude = 26; // Height of the wave
        const waveFrequency = 0.071; // Controls the wave spacing
        let waveD = 'M0,224';

        for (let x = 0; x <= 1440; x += 80) {
            const y = 200 + Math.sin((x * waveFrequency) + wavePhase) * waveAmplitude;
            waveD += `L${x},${y}`;
        }

        waveD += 'L1440,320L0,320Z';
        wavePath.setAttribute('d', waveD);

        requestAnimationFrame(animateWave);
    }

    // Start the animation
    animateWave();

    //stars
    const starryBackground = document.querySelector('.starry-background');

// Number of stars to generate
const numberOfStars = 10;

for (let i = 0; i < numberOfStars; i++) {
    const star = document.createElement('div');
    star.classList.add('star');

    // Random position
    star.style.top = `${Math.random() * 100}vh`;
    star.style.left = `${Math.random() * 100}vw`;

    // Random sizes between 3px and 6px
    const size = Math.random() * 10 + 8; // Size between 3px and 6px
    star.style.width = `${size}px`;
    star.style.height = `${size}px`;

    // Random animation speed for each star
    const sparkleDuration = Math.random() * 2 + 0.5; // Speed between 1s and 3s
    star.style.animationDuration = `${sparkleDuration}s`;

    starryBackground.appendChild(star);
}


</script>
</x-app-layout>
