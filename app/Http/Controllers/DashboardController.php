<?php

namespace App\Http\Controllers;
use App\Models\home_info;
use Illuminate\Http\Request;
use App\Models\Faq;

class DashboardController extends Controller
{
    // public function index()
    // {
    //      // Fetch the 'aboutUs' data from the database
    //      $homeInfo = home_info::first(); // Retrieves the first record, assuming there is only one row with the 'aboutUs' field
        
    //      // Pass the data to the view
    //      return view('dashboard', compact('homeInfo')); // 'homeInfo' will be available in your Blade view
    // }
    public function index()
    {
        $faqs = Faq::all();
        return view('dashboard', compact('faqs'));  
    }
}
