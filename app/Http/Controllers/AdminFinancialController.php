<?php
namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class AdminFinancialController extends Controller
{
    public function index(Request $request)
    {
        $query = Scholarship::query();

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Filter by name
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Filter by application deadline
        if ($request->has('deadline') && $request->deadline != '') {
            $query->where('application_deadline', $request->deadline);
        }


        $scholarships = $query->get();
        $types = Scholarship::distinct()->pluck('type'); // Get unique types for the filter dropdown

        return view('admin.financial.index', compact('scholarships', 'types'));
    }

    public function create()
    {
        return view('admin.financial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'participating_programmes' => 'required|string',
            'eligibility_criteria' => 'required|string',
            'scholarship_value' => 'required|string',
            'documents_required' => 'required|string',
            'application_procedure' => 'required|string',
            'application_deadline' => 'required|date',
            'terms_conditions' => 'nullable|string',
            'further_info' => 'nullable|string',
        ]);

        Scholarship::create($request->all());

        return redirect()->route('admin.financial.scholarships')->with('success', 'Scholarship added successfully.');
    }

    public function edit($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        return view('admin.financial.edit', compact('scholarship'));
    }

    public function update(Request $request, $id)
    {
        $scholarship = Scholarship::findOrFail($id);

        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
            'participating_programmes' => 'required|string',
            'eligibility_criteria' => 'required|string',
            'scholarship_value' => 'required|string',
            'documents_required' => 'required|string',
            'application_procedure' => 'required|string',
            'application_deadline' => 'required|date',
            'terms_conditions' => 'nullable|string',
            'further_info' => 'nullable|string',
        ]);

        $scholarship->update($request->all());

        return redirect()->route('admin.financial.scholarships')->with('success', 'Scholarship updated successfully.');
    }

    public function destroy($id)
    {
        Scholarship::findOrFail($id)->delete();
        return redirect()->route('admin.financial.scholarships')->with('success', 'Scholarship deleted successfully.');
    }
}
