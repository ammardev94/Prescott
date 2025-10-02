<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\SeoScript;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeoScriptRequest;
use Illuminate\Support\Facades\Session;

class SeoScriptController extends Controller
{
    public function edit(int $id)
    {
        $seoScript = SeoScript::findOrFail($id);
        return view('admin.seo_scripts.edit', compact('seoScript'));
    }

    public function update(int $id, SeoScriptRequest $request)
    {
        try {
            $validated = $request->validated();
            $seoScript = SeoScript::findOrFail($id);

            $seoScript->update($validated);
            Session::flash('msg.success', 'SEO Script updated successfully.');
            return redirect()->route('admin.seo-scripts.edit', [$seoScript->id]);
        } catch (Exception $e) {
            Session::flash('msg.error', 'Failed to update SEO Script. ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
