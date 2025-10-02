<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\View\View;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::paginate(10);
        return view('admin.project.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.project.create');
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail_img')) {
                $validated['thumbnail_img'] = $request->file('thumbnail_img')->store('project/thumbnails', 'public');
            }

            if ($request->hasFile('section_one_button_file')) {
                $validated['section_one_button_file'] = $request->file('section_one_button_file')->store('project/sheets', 'public');
            }

            if ($request->hasFile('images')) {
                $validated['images'] = collect($request->file('images'))
                    ->map(fn($file) => $file->store('project/images', 'public'))
                    ->toArray();
            }

            Project::create($validated);

            Session::flash('msg.success', 'project created successfully.');
            return redirect()->route('admin.project.index');

        } catch (Exception $e) {

            Log::error($e->getMessage());
            Session::flash('msg.error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit(int $id): View
    {
        $project = Project::findOrFail($id);
        return view('admin.project.edit', compact('project'));
    }

    public function update(int $id, ProjectRequest $request): RedirectResponse
    {
        try {
            $project = Project::findOrFail($id);
            $validated = $request->validated();

            if ($request->hasFile('thumbnail_img')) {
                Storage::disk('public')->delete($project->thumbnail_img);
                $validated['thumbnail_img'] = $request->file('thumbnail_img')->store('project/thumbnails', 'public');
            }

            if ($request->hasFile('section_one_button_file')) {
                Storage::disk('public')->delete($project->section_one_button_file);
                $validated['section_one_button_file'] = $request->file('section_one_button_file')->store('project/sheets', 'public');
            }


            if ($request->hasFile('images')) {
                if (is_array($project->images)) {
                    foreach ($project->images as $img) {
                        Storage::disk('public')->delete($img);
                    }
                }
                $validated['images'] = collect($request->file('images'))
                    ->map(fn($file) => $file->store('project/images', 'public'))
                    ->toArray();
            }

            $project->update($validated);

            Session::flash('msg.success', 'project updated successfully.');
            return redirect()->route('admin.project.index');

        } catch (Exception $e) {
            Session::flash('msg.error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $project = Project::findOrFail($id);

        if ($project->thumbnail_img) {
            Storage::disk('public')->delete($project->thumbnail_img);
        }

        if ($project->section_one_button_file) {
            Storage::disk('public')->delete($project->section_one_button_file);
        }

        if (is_array($project->images)) {
            foreach ($project->images as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $project->delete();

        Session::flash('msg.success', 'project deleted successfully.');
        return redirect()->route('admin.project.index');
    }
}
