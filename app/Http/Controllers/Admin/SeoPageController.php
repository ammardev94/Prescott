<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Page;
use App\Models\SeoPage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeoPageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class SeoPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $seoPages = SeoPage::with('page')->paginate(10);
        return view('admin.seo_pages.index', compact('seoPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $pages = Page::all(['id', 'title']);
        return view('admin.seo_pages.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeoPageRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            SeoPage::create($validated);

            Session::flash('msg.success', 'SEO Page created successfully.');
            return redirect()->route('admin.seo_pages.index');

        } catch (Exception $e) {

            Log::error($e->getMessage());

            Session::flash('msg.error', 'Failed to create SEO Page. ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $seoPage = SeoPage::findOrFail($id);
        $pages = Page::all(['id', 'title']);
        return view('admin.seo_pages.edit', compact('seoPage', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, SeoPageRequest $request): RedirectResponse
    {
        try {
            $seoPage = SeoPage::findOrFail($id);
            $validated = $request->validated();

            $seoPage->update($validated);

            Session::flash('msg.success', 'SEO Page updated successfully.');
            return redirect()->route('admin.seo_pages.index');

        } catch (Exception $e) {
            Session::flash('msg.error', 'Failed to update SEO Page. ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $seoPage = SeoPage::findOrFail($id);
            $seoPage->delete();

            Session::flash('msg.success', 'SEO Page deleted successfully.');
            return redirect()->route('admin.seo_pages.index');

        } catch (Exception $e) {
            Session::flash('msg.error', 'Failed to delete SEO Page. ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
