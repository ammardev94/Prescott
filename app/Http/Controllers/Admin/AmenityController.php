<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Amenity;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\AmenityRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AmenityController extends Controller
{
    public function index(): View
    {
        $amenities = Amenity::with('project')->paginate(10);
        return view('admin.amenity.index', compact('amenities'));
    }

    public function create(): View
    {
        $projects = Project::select('title', 'id')->get();
        return view('admin.amenity.create', compact('projects'));
    }

    public function store(AmenityRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('img')) {
                $validated['img'] = $request->file('img')->store('amenities', 'public');
            }

            Amenity::create($validated);

            Session::flash('msg.success', 'Amenity created successfully.');
            return redirect()->route('admin.amenity.index');

        } catch (Exception $e) {
            Log::error('Amenity Store Error: ' . $e->getMessage());
            Session::flash('msg.error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit(int $id): View
    {
        $amenity = Amenity::findOrFail($id);
        $projects = Project::select('title', 'id')->get();
        return view('admin.amenity.edit', compact('amenity', 'projects'));
    }

    public function update(AmenityRequest $request, int $id): RedirectResponse
    {
        try {
            $amenity = Amenity::findOrFail($id);

            $validated = $request->validated();

            if ($request->hasFile('img')) {
                if ($amenity->img && Storage::disk('public')->exists($amenity->img)) {
                    Storage::disk('public')->delete($amenity->img);
                }
                $validated['img'] = $request->file('img')->store('amenities', 'public');
            }

            $amenity->update($validated);

            Session::flash('msg.success', 'Amenity updated successfully.');
            return redirect()->route('admin.amenity.index');

        } catch (Exception $e) {
            Log::error('Amenity Update Error: ' . $e->getMessage());
            Session::flash('msg.error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $amenity = Amenity::findOrFail($id);

            if ($amenity->img && Storage::disk('public')->exists($amenity->img)) {
                Storage::disk('public')->delete($amenity->img);
            }

            $amenity->delete();

            Session::flash('msg.success', 'Amenity deleted successfully.');
            return redirect()->route('admin.amenity.index');

        } catch (Exception $e) {
            Log::error('Amenity Delete Error: ' . $e->getMessage());
            Session::flash('msg.error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
