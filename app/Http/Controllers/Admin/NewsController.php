<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\News;
use Illuminate\View\View;
use App\Http\Requests\NewsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $news = News::paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('img')) {
                $validated['img'] = $request->file('img')->store('news', 'public');
            }

            if ($request->hasFile('paragraph_one_img')) {
                $validated['paragraph_one_img'] = $request->file('paragraph_one_img')->store('news/paragraphs', 'public');
            }
            if ($request->hasFile('paragraph_two_img')) {
                $validated['paragraph_two_img'] = $request->file('paragraph_two_img')->store('news/paragraphs', 'public');
            }
            if ($request->hasFile('paragraph_three_img')) {
                $validated['paragraph_three_img'] = $request->file('paragraph_three_img')->store('news/paragraphs', 'public');
            }

            $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

            News::create($validated);

            Session::flash('msg.success', 'News created successfully.');
            return redirect()->route('admin.news.index');

        } catch (Exception $e) {
            Session::flash('msg.error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, NewsRequest $request): RedirectResponse
    {
        try {
            $news = News::findOrFail($id);
            $validated = $request->validated();

            $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

            if ($request->hasFile('img')) {
                if ($news->img) {
                    Storage::disk('public')->delete($news->img);
                }
                $validated['img'] = $request->file('img')->store('news', 'public');
            }

            if ($request->hasFile('paragraph_one_img')) {
                if ($news->paragraph_one_img) {
                    Storage::disk('public')->delete($news->paragraph_one_img);
                }
                $validated['paragraph_one_img'] = $request->file('paragraph_one_img')->store('news/paragraphs', 'public');
            }

            if ($request->hasFile('paragraph_two_img')) {
                if ($news->paragraph_two_img) {
                    Storage::disk('public')->delete($news->paragraph_two_img);
                }
                $validated['paragraph_two_img'] = $request->file('paragraph_two_img')->store('news/paragraphs', 'public');
            }

            if ($request->hasFile('paragraph_three_img')) {
                if ($news->paragraph_three_img) {
                    Storage::disk('public')->delete($news->paragraph_three_img);
                }
                $validated['paragraph_three_img'] = $request->file('paragraph_three_img')->store('news/paragraphs', 'public');
            }

            $news->update($validated);

            Session::flash('msg.success', 'News updated successfully.');
            return redirect()->route('admin.news.index');

        } catch (Exception $e) {
            Session::flash('msg.error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $news = News::findOrFail($id);

            if ($news->img) {
                Storage::disk('public')->delete($news->img);
            }

            if ($news->paragraph_one_img) {
                Storage::disk('public')->delete($news->paragraph_one_img);
            }

            if ($news->paragraph_two_img) {
                Storage::disk('public')->delete($news->paragraph_two_img);
            }

            if ($news->paragraph_three_img) {
                Storage::disk('public')->delete($news->paragraph_three_img);
            }

            $news->delete();

            Session::flash('msg.success', 'News deleted successfully.');
            return redirect()->route('admin.news.index');

        } catch (Exception $e) {
            Session::flash('msg.error', $e->getMessage());
            return redirect()->back();
        }
    }


}
