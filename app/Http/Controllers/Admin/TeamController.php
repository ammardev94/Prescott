<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Team;
use Illuminate\View\View;
use App\Http\Requests\TeamRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{
    /**
     * Display a listing of the teams.
     */
    public function index(): View
    {
        $teams = Team::latest()->paginate(10);
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new team.
     */
    public function create(): View
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created team in storage.
     */
    public function store(TeamRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('img')) {
                $data['img'] = $request->file('img')->store('teams', 'public');
            }

            Team::create($data);

            Session::flash('msg.success', 'Team member created successfully.');
            return redirect()->route('admin.teams.index');
        } catch (Exception $e) {
            Session::flash('msg.error', 'Failed to create team member. ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified team.
     */
    public function edit(int $id): View
    {
        $team = Team::findOrFail($id);
        return view('admin.teams.edit', compact('team'));
    }


    /**
     * Update the specified team in storage.
     */
    public function update(int $id, TeamRequest $request): RedirectResponse
    {
        try {
            $team = Team::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('img')) {
                if ($team->img && Storage::disk('public')->exists($team->img)) {
                    Storage::disk('public')->delete($team->img);
                }
                $data['img'] = $request->file('img')->store('teams', 'public');
            }

            $team->update($data);

            Session::flash('msg.success', 'Team member updated successfully.');
            return redirect()->route('admin.teams.index');
        } catch (Exception $e) {
            Session::flash('msg.error', 'Failed to update team member. ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified team from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $team = Team::findOrFail($id);

            if ($team->img && Storage::disk('public')->exists($team->img)) {
                Storage::disk('public')->delete($team->img);
            }

            $team->delete();

            Session::flash('msg.success', 'Team member deleted successfully.');
            return redirect()->route('admin.teams.index');
        } catch (Exception $e) {
            Session::flash('msg.error', 'Failed to delete team member. ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
