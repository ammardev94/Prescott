<?php

namespace App\Http\Controllers\Admin;

use App\Models\Career;
use App\Http\Controllers\Controller;
use App\Http\Requests\CareerRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function __construct()
    {
        $this->middleware('roleAuth:admin')->only(['index', 'show', 'destroy']);
    }

    /**
     * Display a listing of the careers (admin only).
     */
    public function index()
    {
        $careers = Career::latest()->paginate(20);
        return view('admin.careers.index', compact('careers'));
    }

    /**
     * Store a newly created career application (public).
     */
    public function store(CareerRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('careers', 'public');
        }

        if ($request->hasFile('cover_letter')) {
            $data['cover_letter'] = $request->file('cover_letter')->store('careers', 'public');
        }

        $career = Career::create($data);

        return response()->json([
            'message' => 'Your application has been submitted successfully.',
            'data' => $career,
        ], 201);
    }

    /**
     * Display a specific career application (admin only).
     */
    public function show($id)
    {
        $career = Career::findOrFail($id);
        return view('admin.careers.show', compact('career'));
    }

    /**
     * Remove a specific career application (admin only).
     */
    public function destroy($id)
    {
        $career = Career::findOrFail($id);

        if ($career->resume && Storage::disk('public')->exists($career->resume)) {
            Storage::disk('public')->delete($career->resume);
        }

        if ($career->cover_letter && Storage::disk('public')->exists($career->cover_letter)) {
            Storage::disk('public')->delete($career->cover_letter);
        }

        $career->delete();

        Session::flash('msg.success', 'Career application deleted successfully.');
        return redirect()->route('admin.careers.index');
    }
}
