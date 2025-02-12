<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Scholarship;

class FinancialController extends Controller
{
    public function needBased()
    {
        // Fetch scholarships specifically related to need-based
        $scholarships = Scholarship::where('type', 'Need-Based Scholarship')->get();
        return view('financial.need_base', compact('scholarships'));
    }

    public function external()
    {
        // Fetch scholarships specifically related to external sponsorships
        $scholarships = Scholarship::where('type', 'External Sponsorship')->get();
        return view('financial.external_sponsor', compact('scholarships'));
    }

    public function loan()
    {
        // Fetch scholarships specifically related to study loans
        $scholarships = Scholarship::where('type', 'Study Loan')->get();
        return view('financial.study_loan', compact('scholarships'));
    }

    public function show(Scholarship $scholarship)
    {
        return response()->json($scholarship);
    }
    // public function scrapeScholarships()
    // {
    //     $client = new Client();
    //     $url = 'https://scholarship.sunway.edu.my/scholarships/need-based-scholarships'; // Replace with the target website URL

    //     // Fetch the webpage content
    //     $response = $client->request('GET', $url);
    //     $html = $response->getBody()->getContents();

    //     // Parse the HTML using DomCrawler
    //     $crawler = new Crawler($html);

    //     // Example: Scrape scholarship data (adjust selectors based on the website's structure)
    //     $crawler->filter('.field.field--name-field-paragraph.field--type-entity-reference-revisions.field--label-hidden.field__items .accordion-item')->each(function (Crawler $node) {
    //         // Extract the scholarship type from the button text
    //         $type = $node->filter('.accordion-button')->text();
        
    //         // Extract specific details from the body
    //         $contents = $node->filter('.accordion-body')->filter('ul, p')->each(function (Crawler $item) {
    //             return $item->text(); // Extract text for each list item or paragraph
    //         });
        
    //         // Assign contents to specific fields
    //         $participatingProgrammes = $contents[0] ?? '';  // First item (if exists)
    //         $eligibilityCriteria = $contents[1] ?? '';     // Second item (if exists)
    //         $scholarshipValue = $contents[2] ?? '';        // Third item (if exists)
    //         $documentsRequired = $contents[3] ?? '';      // Fourth item (if exists)
    //         $applicationProcedure = $contents[4] ?? '';   // Fifth item (if exists)
    //         $applicationDeadline = $contents[5] ?? '';    // Sixth item (if exists)
    //         $termsConditions = $contents[6] ?? '';        // Seventh item (if exists)
        
    //         // Log data to the browser console
    //         echo "<script>console.log('Scholarship Type: " . addslashes($type) . "');</script>";
    //         echo "<script>console.log('Participating Programmes: " . addslashes($participatingProgrammes) . "');</script>";
    //         echo "<script>console.log('Eligibility Criteria: " . addslashes($eligibilityCriteria) . "');</script>";
    //         echo "<script>console.log('Scholarship Value: " . addslashes($scholarshipValue) . "');</script>";
    //         echo "<script>console.log('Documents Required: " . addslashes($documentsRequired) . "');</script>";
    //         echo "<script>console.log('Application Procedure: " . addslashes($applicationProcedure) . "');</script>";
    //         echo "<script>console.log('Application Deadline: " . addslashes($applicationDeadline) . "');</script>";
    //         echo "<script>console.log('Terms & Conditions: " . addslashes($termsConditions) . "');</script>";
        
    //         // Save to the database
    //         Scholarship::create([
    //             'type' => $type,
    //             'participating_programmes' => $participatingProgrammes,
    //             'eligibility_criteria' => $eligibilityCriteria,
    //             'scholarship_value' => $scholarshipValue,
    //             'documents_required' => $documentsRequired,
    //             'application_procedure' => $applicationProcedure,
    //             'application_deadline' => $applicationDeadline,
    //             'terms_conditions' => $termsConditions,
    //         ]);
    //     });
    // }
}        