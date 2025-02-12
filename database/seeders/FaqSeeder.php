<?php
use App\Models\Faq;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run()
    {
        Faq::create([
            'question' => 'How do I search for courses?',
            'answer' => 'You can search for courses by using the search bar on the homepage. Enter the course name or related keywords to find relevant results.'
        ]);

        Faq::create([
            'question' => 'What information is provided for each course?',
            'answer' => 'Each course listing includes details such as course duration, eligibility criteria, tuition fees, and institution information.'
        ]);

        // Add more FAQs as needed
    }
}