<?php

// namespace App\Services;

// use GuzzleHttp\Client;
// use Symfony\Component\DomCrawler\Crawler;
// use App\Models\Scholarship;

// class WebScraperService
// {
//     protected $client;

//     public function __construct()
//     {
//         $this->client = new Client();
//     }

//     public function scrape($url)
//     {
//         // Fetch the web page content
//         $response = $this->client->request('GET', $url);
//         $html = $response->getBody()->getContents();

//         // Parse the HTML using DomCrawler
//         $crawler = new Crawler($html);

//         $scholarships = [];

//         // Check if .accordion exists
//         if ($crawler->filter('.accordion')->count() > 0) {
//             $crawler->filter('.accordion')->each(function ($accordionNode) use (&$scholarships) {
//                 $scholarship = [
//                     'type' => $accordionNode->filter('.nav-link')->count() > 0 
//                         ? $accordionNode->filter('.nav-link')->text() 
//                         : 'Unknown', // Scholarship type
//                     'participating_programmes' => null,
//                     'eligibility_criteria' => null,
//                     'scholarship_value' => null,
//                     'documents_required' => null,
//                     'application_procedure' => null,
//                     'application_deadline' => null,
//                     'terms_conditions' => null,
//                 ];

//                 // Iterate through each .accordion-item within the current .accordion
//                 $accordionNode->filter('.accordion-item')->each(function ($itemNode) use (&$scholarship) {
//                     // Check if .accordion-button exists
//                     if ($itemNode->filter('.accordion-button')->count() > 0) {
//                         $headerText = $itemNode->filter('.accordion-button')->text();

//                         // Check if .accordion-collapse exists
//                         if ($itemNode->filter('.accordion-collapse')->count() > 0) {
//                             $content = $itemNode->filter('.accordion-collapse')->text();

//                             // Match the header text to the corresponding field
//                             if (stripos($headerText, 'Participating Programme') !== false) {
//                                 $scholarship['participating_programmes'] = $content;
//                             } elseif (stripos($headerText, 'Eligibility Criteria') !== false) {
//                                 $scholarship['eligibility_criteria'] = $content;
//                             } elseif (stripos($headerText, 'Scholarship Value') !== false) {
//                                 $scholarship['scholarship_value'] = $content;
//                             } elseif (stripos($headerText, 'Documents Required') !== false) {
//                                 $scholarship['documents_required'] = $content;
//                             } elseif (stripos($headerText, 'Application Procedure') !== false) {
//                                 $scholarship['application_procedure'] = $content;
//                             } elseif (stripos($headerText, 'Application Deadline') !== false) {
//                                 $scholarship['application_deadline'] = $content;
//                             } elseif (stripos($headerText, 'Terms and Conditions') !== false) {
//                                 $scholarship['terms_conditions'] = $content;
//                             }
//                         }
//                     }
//                 });

//                 $scholarships[] = $scholarship;
//             });
//         } else {
//             throw new \Exception('No .accordion element found on the page.');
//         }

//         // Save scholarships to the database
//         foreach ($scholarships as $data) {
//             Scholarship::updateOrCreate(
//                 ['type' => $data['type']], // Unique identifier for each scholarship
//                 $data
//             );
//         }
//     }
// }