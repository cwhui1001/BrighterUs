// Install with npm install @mendable/firecrawl-js
import FireCrawlApp from '@mendable/firecrawl-js';

const app = new FireCrawlApp({apiKey: "fc-492b53f642f240d08ccbdd621746144f"});

const scrapeResult = await app.scrapeUrl("https://scholarship.sunway.edu.my/scholarships/need-based-scholarships", {
	formats: [ "markdown" ],
});




async function scrapeContent() {
    const app = new FireCrawlApp({ apiKey: "fc-492b53f642f240d08ccbdd621746144f" });
    
    try {
        const scrapeResult = await app.scrapeUrl("https://scholarship.sunway.edu.my/scholarships/need-based-scholarships", { formats: ["markdown"] });
        
        // Send the scraped content to the backend via AJAX
        const response = await fetch('financial', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ content: scrapeResult.content })
        });

        const data = await response.json();

        // Display the scraped content in the content div
        document.getElementById('content').innerHTML = data.content;
    } catch (error) {
        console.error('Error scraping content:', error);
    }
}

scrapeContent();


