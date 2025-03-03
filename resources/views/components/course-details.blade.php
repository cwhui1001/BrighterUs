
<div class="show-course-card">
    <h1 class="course-title">{{ $course->name }}</h1>

    <div class="uni-logo">
        <img src="{{ $course->university->logo }}">
    </div>
    
    <div class="course-details">
        <div class="detail-item">
            <span class="label">Category:</span> {{ $course->category->name }}
        </div>
        <div class="detail-item">
            <span class="label">Field:</span> {{ $course->field?->name ?? '-' }}
        </div>
        <div class="detail-item">
            <span class="label">University:</span> {{ $course->university->name }}
        </div>
        
        <div class="detail-item">
            <span class="label">QS Ranking:</span> {{ $course->ranking->value }}
        </div>
    </div>

    <div class="description">
        <h3>Description</h3>
        <p>{{ $course->description }}</p>
    </div>
    <br>
    <div>
        <span class="label">Location:</span> {{ $course->university->name }}, {{ $course->location->name }}
        <div class="map-container" style="border-radius: 20px; overflow: hidden; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
            <iframe 
                width="100%" 
                height="400" 
                frameborder="0" 
                style="border-radius: 20px; border:0;" 
                allowfullscreen 
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA5tpY4VA4sNlgE-zqHJx9pmCw6aIDNONY&q={{ urlencode($course->university->name) }}">
            </iframe>
        </div>
    </div>
    <br><br>
    <div class="tuition-fee">
        <div class="cost"><strong>Total Tuition Fee:</strong><br> RM {{ number_format($course->budget, 0)  }}</div>
        <div class="cost">
            <p>✅ PTPN</p>
            <p>✅ Scholarships Available</p>
        </div>
    </div>
    <br>
    @if(!empty($course->link))
        <a href="{{ $course->link }}" target="_blank">
            <button class="ctaa-button">More Info</button>
        </a>
    @endif
    <a href="{{ url('/financial/need-based') }}" target="_blank">
        <button class="ctaa-button">View Scholarships</button>
    </a>
    <a href="{{ url('/financial/study-loan') }}" target="_blank">
        <button class="ctaa-button">View study loan</button>
    </a>
</div>