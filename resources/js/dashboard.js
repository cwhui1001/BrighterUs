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

window.onload = function () {
  document.querySelectorAll('.faq-toggle').forEach((button) => {
      button.addEventListener('click', function () {
          toggleFaq(this);
      });
  });
};



const sections = [
  {
      title: "Explore Top Universities All Over Malaysia!",
      images: [
          "https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Sunway_logo.jpg/1200px-Sunway_logo.jpg",
          "https://jmeducationgroup.com/wp-content/uploads/2021/03/Taylors-University-Logo.jpeg",
          "https://d30mzt1bxg5llt.cloudfront.net/public/uploads/images/_signatoryLogo/2016-MonashUniversityMALAYSIA_2-MonoCMYKoutlines.jpg",
          "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQR8y9ZDsvA9NHsWgJQbo7g9C97_XgzkS8bww&s",
          "https://upload.wikimedia.org/wikipedia/commons/2/29/Multimedia_University_secondary_logo_2020.png",
          "https://erasmusplusfriends.eu/wp-content/uploads/2019/05/APU-Logo_Final_Vertical_V1_HR1-copy-1024x966.png"
      ],
      description: "Compare Universities by price, ranking, location just by your finger tips!",
      link: window.appUrls.courses,
      linkText: "See All Universities",
      useUniversityLogos: true
  },
  {
      title: "Grab Chances of Getting Full Scholarships!",
      images: [
          "https://sunway.edu.my/sites/default/files/inline-images/jcf-logo%402x.png",
          "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNOwxmmuX1D6LAWoX7ZU_AgDXtVHG5kn4Yhy-cUhQ-tlCrxAwWGS4LBKGeociHGgtdaBE&usqp=CAU",
          "https://logolook.net/wp-content/uploads/2022/07/Petronas-Logo-2013.png",
          "https://www.khazanah.com.my/media/uploads/2020/06/Yayasan-Hasanah-Logo-1.png",
          "https://mdec.my/static/images/mdcap/resource-bnm-logo.png",
          "https://ik.imagekit.io/impian/kouk-foundation.jpg?updatedAt=1689601512471"
      ],
      description: "Get scholarships and sponsorships on tuition fees, hostels, flights, and many more grants!",
      link: window.appUrls.needBased,
      linkText: "See All Scholarships",
      useUniversityLogos: true
  },
  {
      title: "Get Updated with Upcoming Education Fair!",
      images: [window.appImages.event1],
      description: "Stay updated and get notified about all the upcoming education fairs across Malaysia!",
      link: window.appUrls.events,
      linkText: "Explore All Events",
      useUniversityLogos: false
  },
  {
      title: "Get Personalized Career Advice with MBTI test!",
      images: [window.appImages.mbti],
      description: "Get personalized pathway advice by going through a quick career assessment!",
      link: window.appUrls.career,
      linkText: "Take a career test",
      useUniversityLogos: false
  }
];

const container = document.getElementById('why-choose-us-container');
sections.forEach(section => {
  const sectionDiv = document.createElement('div');
  sectionDiv.classList.add('why-choose-us-section');

  const title = document.createElement('h3');
  title.classList.add('sub-title3');
  title.innerText = section.title;
  sectionDiv.appendChild(title);

  const imageContainer = document.createElement('div');
  if (section.useUniversityLogos) {
      imageContainer.classList.add('university-logos');
  }
  section.images.forEach(imageSrc => {
      const img = document.createElement('img');
      img.src = imageSrc;
      imageContainer.appendChild(img);
  });
  sectionDiv.appendChild(imageContainer);

  const description = document.createElement('h3');
  description.innerText = section.description;
  sectionDiv.appendChild(description);

  const link = document.createElement('a');
  link.classList.add('cta-button', 'mt-4');
  link.href = section.link;
  link.innerText = section.linkText;
  sectionDiv.appendChild(link);

  container.appendChild(sectionDiv);
});