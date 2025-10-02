<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller
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
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Store a newly created career application (public).
     */
    public function store(ContactFormRequest $request)
    {
        $data = $request->validated();

        $contact = Contact::create($data);

        return response()->json([
            'message' => 'Your application has been submitted successfully.',
            'data' => $contact,
        ], 201);
    }

    /**
     * Display a specific career application (admin only).
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove a specific career application (admin only).
     */
    public function destroy($id)
    {
        $career = Contact::findOrFail($id);

        $career->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
