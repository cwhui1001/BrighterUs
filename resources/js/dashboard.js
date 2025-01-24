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


//Stars
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



function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    section.scrollIntoView({ behavior: 'smooth' });
}

// Toggle the visibility of additional details
function toggleDetails() {
    const detailsContent = document.querySelector('.details-content');
    if (detailsContent.style.display === 'block') {
        detailsContent.style.display = 'none';
    } else {
        detailsContent.style.display = 'block';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const boxes = document.querySelectorAll(".flow-up");
  
    const revealOnScroll = () => {
      const triggerBottom = window.innerHeight / 5 * 4;
  
      boxes.forEach(box => {
        const boxTop = box.getBoundingClientRect().top;
  
        if (boxTop < triggerBottom) {
          box.classList.add("show");
        } else {
          box.classList.remove("show");
        }
      });
    };
  
    window.addEventListener("scroll", revealOnScroll);
  
    // Initial check
    revealOnScroll();
  });