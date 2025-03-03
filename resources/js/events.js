document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".countdown-box").forEach(box => {
        const eventId = box.id.replace("countdown-", "");
        const eventTime = new Date(box.dataset.time).getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = eventTime - now;

            if (distance < 0) {
                box.innerHTML = `<p class="event-started">Event has started!</p>`;
                return;
            }
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            box.innerHTML = `
                <div class="countdown-element"><span class="countdown-value">${days}</span><span class="countdown-label">Days</span></div>
                <div class="countdown-element"><span class="countdown-value">${hours}</span><span class="countdown-label">Hours</span></div>
                <div class="countdown-element"><span class="countdown-value">${minutes}</span><span class="countdown-label">Minutes</span></div>
                <div class="countdown-element"><span class="countdown-value">${seconds}</span><span class="countdown-label">Seconds</span></div>
            `;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
});

window.showMap = function (mapId, placeId) {
    console.log("Clicked map icon!");

    const overlay = document.querySelector(".overlay");
    const mapPopup = document.getElementById(mapId)?.parentElement;
    if (!overlay || !mapPopup) {
        console.error("Overlay or map popup not found");
        return;
    }

    overlay.style.display = "block";
    mapPopup.style.display = "block";

    const mapElement = document.getElementById(mapId);
    if (!mapElement) {
        console.error("Map element not found:", mapId);
        return;
    }

    const map = new google.maps.Map(mapElement, { zoom: 15 });
    const service = new google.maps.places.PlacesService(map);

    service.getDetails({ placeId, fields: ["geometry"] }, (place, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK && place.geometry) {
            new google.maps.Marker({ map, position: place.geometry.location });
            map.setCenter(place.geometry.location);
        } else {
            console.error("Place details request failed:", status);
        }
    });

    // Ensure the close button inside the current map popup closes only that popup
    const closeBtn = mapPopup.querySelector(".close-btn");
    if (closeBtn) {
        closeBtn.onclick = function () {
            mapPopup.style.display = "none";
            overlay.style.display = "none";
        };
    }
};

// Close Map Function
// Ensure the function is available globally
function closeMap() {
    // Find all popups and overlays
    const popups = document.querySelectorAll(".map-popup");
    const overlay = document.querySelector(".overlay");

    // Hide only the currently visible popups
    popups.forEach(popup => {
        if (popup.style.display === "block") {
            popup.style.display = "none";
        }
    });

    if (overlay) {
        overlay.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Assign the function to the close button and overlay
    const closeBtn = document.querySelector(".map-popup .close-btn");
    const overlay = document.querySelector(".overlay");

    if (closeBtn) closeBtn.addEventListener("click", closeMap);
    if (overlay) overlay.addEventListener("click", closeMap);
});