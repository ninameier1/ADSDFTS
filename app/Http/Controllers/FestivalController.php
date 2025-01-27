<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    // Display a list of festivals with bus and ticket counts
    public function index(Request $request)
    {
        // Determine the sorting column and direction from the request
        $sortColumn = $request->get('sort', 'date'); // Default sort by 'date'
        $sortDirection = $request->get('direction', 'asc'); // Default direction is 'asc'

        // Validate that the sorting column is allowed
        $allowedColumns = ['name', 'date', 'location', 'genre', 'buses_count', 'bustickets_count'];
        if (!in_array($sortColumn, $allowedColumns))
        {
            $sortColumn = 'date'; // Fallback to default column
        }

        // Fetch festivals with bus and ticket counts, sorted by the requested column and direction
        $festivals = Festival::withCount(['buses', 'bustickets'])
            ->orderBy($sortColumn, $sortDirection)
            ->get();

        // Return the 'festivals.index' view, passing the festivals data and sorting info
        return view('festivals.index', compact('festivals', 'sortColumn', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // Show a specific festival to customers
    public function show($id)
    {
        // Fetch the specific festival by its ID
        $festival = Festival::findOrFail($id);

        // Return the 'festivals.show' view for customers, passing the festival data
        return view('festivals.show', compact('festival'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function welcome()
    {
        $festivals = Festival::all(); // Fetch all festivals
        return view('welcome', compact('festivals'));
    }

    public function tripPlanner()
    {
        $festivals = Festival::all(); // Fetch all festivals
        $from = 'Your Starting Point';

        return view('trip-planner', compact('festivals', 'from'));
    }

    public function redirectToTicketBooking(Request $request)
    {
        // Get the data passed via GET
        $from = $request->from;
        $to = $request->to;

        // Pass the data to the view
        return view('bustickets.create', [
            'from' => $from,
            'to' => $to, // Pass the festival object
        ]);
    }





}
