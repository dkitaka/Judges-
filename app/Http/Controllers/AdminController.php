<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with judges list
     */
    public function index()
    {
        $judges = Judge::all();
        return view('admin.index', compact('judges'));
    }

    /**
     * Show the form for creating a new judge
     */
    public function create()
    {
        return view('admin.judges.create');
    }

    /**
     * Store a newly created judge
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:judges|max:255',
            'display_name' => 'required|max:255',
        ]);

        Judge::create($validated);

        return redirect()->route('admin.index')
            ->with('success', 'Judge created successfully.');
    }

    /**
     * Delete a judge
     */
    public function destroy(Judge $judge)
    {
        $judge->delete();
        return redirect()->route('admin.index')
            ->with('success', 'Judge deleted successfully.');
    }
}
