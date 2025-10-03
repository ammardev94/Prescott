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
                $validated['thumbnail_img'] = $request->file('thumbnail_img')->store('projects/thumbnails', 'public');
            }

            if ($request->hasFile('video_thumbnail_img')) {
                $validated['video_thumbnail_img'] = $request->file('video_thumbnail_img')->store('projects/video_thumbnails', 'public');
            }

            if ($request->hasFile('reception_img')) {
                $validated['reception_img'] = $request->file('reception_img')->store('projects/reception', 'public');
            }

            if ($request->hasFile('exterior_img')) {
                $validated['exterior_img'] = $request->file('exterior_img')->store('projects/exterior', 'public');
            }

            if ($request->hasFile('interior_img')) {
                $validated['interior_img'] = $request->file('interior_img')->store('projects/interior', 'public');
            }

            if ($request->hasFile('section_one_img')) {
                $validated['section_one_img'] = $request->file('section_one_img')->store('projects/section_one', 'public');
            }

            if ($request->hasFile('section_two_img')) {
                $validated['section_two_img'] = $request->file('section_two_img')->store('projects/section_two', 'public');
            }

            if ($request->hasFile('trademark_interior_img')) {
                $validated['trademark_interior_img'] = $request->file('trademark_interior_img')->store('projects/trademark_interior', 'public');
            }

            if ($request->hasFile('section_three_img')) {
                $validated['section_three_img'] = $request->file('section_three_img')->store('projects/section_three', 'public');
            }

            if ($request->hasFile('construction_update_img')) {
                $validated['construction_update_img'] = $request->file('construction_update_img')->store('projects/construction_update', 'public');
            }

            if ($request->hasFile('brochure')) {
                $validated['brochure'] = $request->file('brochure')->store('projects/brochures', 'public');
            }

            if ($request->hasFile('amenities_brochure')) {
                $validated['amenities_brochure'] = $request->file('amenities_brochure')->store('projects/amenities_brochures', 'public');
            }

            if ($request->hasFile('trademark_interior_brochure')) {
                $validated['trademark_interior_brochure'] = $request->file('trademark_interior_brochure')->store('projects/trademark_brochures', 'public');
            }

            if ($request->hasFile('construction_plan')) {
                $validated['construction_plan'] = $request->file('construction_plan')->store('projects/construction_plans', 'public');
            }

            if ($request->hasFile('video')) {
                $validated['video'] = $request->file('video')->store('projects/videos', 'public');
            }

            Project::create($validated);

            Session::flash('msg.success', 'Project created successfully.');
            return redirect()->route('admin.project.index');

        } catch (Exception $e) {
            Log::error('Project Store Error: '.$e->getMessage());
            Session::flash('msg.error', 'Something went wrong: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit(int $id): View
    {
        $project = Project::findOrFail($id);
        return view('admin.project.edit', compact('project'));
    }

    public function update(ProjectRequest $request, int $id): RedirectResponse
    {
        try {
            $project = Project::findOrFail($id);
            
            $validated = $request->validated();

            $imageFields = [
                'thumbnail_img' => 'projects/thumbnails',
                'video_thumbnail_img' => 'projects/video_thumbnails',
                'reception_img' => 'projects/reception',
                'exterior_img' => 'projects/exterior',
                'interior_img' => 'projects/interior',
                'section_one_img' => 'projects/section_one',
                'section_two_img' => 'projects/section_two',
                'section_three_img' => 'projects/section_three',
                'trademark_interior_img' => 'projects/trademark_interior',
                'construction_update_img' => 'projects/construction_update',
            ];

            foreach ($imageFields as $field => $path) {
                if ($request->hasFile($field)) {
                    if ($project->$field && Storage::disk('public')->exists($project->$field)) {
                        Storage::disk('public')->delete($project->$field);
                    }
                    $validated[$field] = $request->file($field)->store($path, 'public');
                }
            }

            $pdfFields = [
                'brochure' => 'projects/brochures',
                'amenities_brochure' => 'projects/amenities_brochures',
                'trademark_interior_brochure' => 'projects/trademark_brochures',
                'construction_plan' => 'projects/construction_plans',
            ];

            foreach ($pdfFields as $field => $path) {
                if ($request->hasFile($field)) {
                    if ($project->$field && Storage::disk('public')->exists($project->$field)) {
                        Storage::disk('public')->delete($project->$field);
                    }
                    $validated[$field] = $request->file($field)->store($path, 'public');
                }
            }

            if ($request->hasFile('video')) {
                if ($project->video && Storage::disk('public')->exists($project->video)) {
                    Storage::disk('public')->delete($project->video);
                }
                $validated['video'] = $request->file('video')->store('projects/videos', 'public');
            }

            $project->update($validated);

            Session::flash('msg.success', 'Project updated successfully.');
            return redirect()->route('admin.project.index');

        } catch (Exception $e) {
            Log::error('Project Update Error: '.$e->getMessage());
            Session::flash('msg.error', 'Something went wrong: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {

            $project = Project::findOrFail($id);

            $fileFields = [
                'thumbnail_img',
                'video_thumbnail_img',
                'reception_img',
                'exterior_img',
                'interior_img',
                'section_one_img',
                'section_two_img',
                'trademark_interior_img',
                'section_three_img',
                'construction_update_img',
                'brochure',
                'amenities_brochure',
                'trademark_interior_brochure',
                'construction_plan',
                'video',
            ];

            foreach ($fileFields as $field) {
                if (!empty($project->$field) && Storage::disk('public')->exists($project->$field)) {
                    Storage::disk('public')->delete($project->$field);
                }
            }

            $project->delete();

            Session::flash('msg.success', 'Project deleted successfully.');
            return redirect()->route('admin.project.index');

        } catch (Exception $e) {
            Log::error('Project Delete Error: '.$e->getMessage());
            Session::flash('msg.error', 'Something went wrong: '.$e->getMessage());
            return redirect()->back();
        }
    }

}
