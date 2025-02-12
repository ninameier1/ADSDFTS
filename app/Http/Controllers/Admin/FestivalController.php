<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FestivalController extends Controller
{
    // Display a list of festivals with bus and ticket counts
    public function index(Request $request)
    {
        // Get search term from the request
        $search = $request->get('search', '');
        // Determine the sorting column and direction from the request
        $sortColumn = $request->get('sort', 'date'); // Default sort by 'date'
        $sortDirection = $request->get('direction', 'asc'); // Default direction is 'asc'

        // Validate that the sorting column is allowed
        $allowedColumns = [
            'name',
            'date',
            'location',
            'genre',
            'buses_count',
            'bustickets_count'
        ];
        if (!in_array($sortColumn, $allowedColumns))
        {
            $sortColumn = 'date'; // Fallback to default column
        }

        // Fetch festivals with bus and ticket counts, sorted by the requested column and direction
        $festivals = Festival::withCount(['buses', 'bustickets'])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%');
                });
            })
            ->orderBy($sortColumn, $sortDirection)
            ->get();

        // Return the 'festivals.index' view, passing the festivals data, sorting info, and search term
        return view('admin.festivals.index', compact('festivals', 'sortColumn', 'sortDirection', 'search'));
    }




    // Show the form to create a new festival (manual creation by admin)
    public function create()
    {
        // Return the 'festivals.create' view where the admin can create a new festival
        return view('admin.festivals.create');
    }

    // Store a new festival (manual creation by admin)
    public function store(Request $request)
    {
        // Validate the incoming request data to ensure proper input
        $validatedData = $request->validate([
            'name' => 'required|string|unique:festivals', // Festival name must be unique
            'date' => 'required|date', // Festival date must be a valid date
            'location' => 'required|string', // Festival location must be a string
            'description' => 'required|string', // Description must be provided
            'genre' => 'nullable|string', // Genre is optional
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add an image
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Save to storage/app/public/images
            $validatedData['image'] = 'storage/' . $imagePath; // Store the full URL path with /storage
        }

        // Create the festival in the database using the validated data
        Festival::create($validatedData);

        // Redirect the admin back to the festivals index page with a success message
        return redirect()->route('admin.festivals.index')->with('success', 'Festival created successfully!');
    }


    // Show a specific festival with bus and ticket counts
    public function show($id)
    {
        // Fetch the specific festival with counts of buses and tickets associated with it
        $festival = Festival::withCount('buses', 'bustickets')->findOrFail($id);

        // Return the 'admin.festivals.show' view, passing the festival data to the view
        return view('admin.festivals.show', compact('festival'));
    }

    // Show the form for editing the specified festival
    public function edit(Festival $festival)
    {
        // Return the 'festivals.edit' view where the admin can edit the festival details
        return view('admin.festivals.edit', compact('festival'));
    }

    // Update the festival after form submission
    public function update(Request $request, Festival $festival)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|unique:festivals,name,' . $festival->id, // Ensure the festival name is unique except for the current festival
            'date' => 'required|date', // Festival date must be a valid date
            'location' => 'required|string', // Festival location must be a string
            'description' => 'required|string', // Description must be provided
            'genre' => 'nullable|string', // Genre is optional
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Update the image too
        ]);

        if ($request->hasFile('image'))
        {
            // Delete the old image if it exists
            if ($festival->image)
            {
                Storage::disk('public')->delete($festival->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = 'storage/' . $imagePath; // Store the full URL path with /storage
        }

        // Update the festival using the validated data
        $festival->update($validatedData);

        // Redirect back to the festivals index page with a success message
        return redirect()->route('admin.festivals.index')->with('success', 'Festival updated successfully!');
    }

    // Remove a festival (delete the festival from the database)
    public function destroy(Festival $festival)
    {
        // Delete the festival from the database
        $festival->delete();

        // Redirect the admin back to the festivals index page with a success message
        return redirect()->route('admin.festivals.index')->with('success', 'Festival deleted successfully!');
    }
}
