<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Support\UploadSanitizer;

class LandingPageController extends Controller
{
    public function edit()
    {
        $landingPage = LandingPage::firstOrFail();
        return view('admin.landing-page.edit', compact('landingPage'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_title' => 'nullable|string|max:255',
            'about_content' => 'nullable|string',
            'mission_title' => 'nullable|string|max:255',
            'mission_content' => 'nullable|string',
            'vision_title' => 'nullable|string|max:255',
            'vision_content' => 'nullable|string',
            'stats1' => 'nullable|string',
            'stats2' => 'nullable|string',
            'stats3' => 'nullable|string',
            'stats4' => 'nullable|string',
            'stats_1' => 'required|integer|min:0',
            'stats_2' => 'required|integer|min:0',
            'stats_3' => 'required|integer|min:0',
            'stats_4' => 'required|integer|min:0',
            'contact_address' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'contact_whatsapp' => 'nullable|string',
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_youtube' => 'nullable|url',
            'footer_description' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string'
        ]);

        $landingPage = LandingPage::firstOrFail();

        if ($request->hasFile('hero_image')) {
            // Delete old image if exists
            if ($landingPage->hero_image) {
                Storage::disk('public')->delete($landingPage->hero_image);
            }
            // $validated['hero_image'] = $request->file('hero_image')->store('landing-page', 'public');
            $validated['hero_image'] = UploadSanitizer::store($request->file('hero_image'), 'landing-page');
        }

        $landingPage->update($validated);

        return redirect()->back()->with('success', 'Landing page has been updated successfully.');
    }
}
