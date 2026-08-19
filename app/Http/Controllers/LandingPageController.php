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
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:3072',
            'about_title' => 'nullable|string|max:255',
            'about_content' => 'nullable|string',
            'mission_title' => 'nullable|string|max:255',
            'mission_content' => 'nullable|string',
            'vision_title' => 'nullable|string|max:255',
            'vision_content' => 'nullable|string',
            'stats1' => 'nullable|string|max:100',
            'stats2' => 'nullable|string|max:100',
            'stats3' => 'nullable|string|max:100',
            'stats4' => 'nullable|string|max:100',
            'stats_1' => 'nullable|integer|min:0',
            'stats_2' => 'nullable|integer|min:0',
            'stats_3' => 'nullable|integer|min:0',
            'stats_4' => 'nullable|integer|min:0',
            'contact_address' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_whatsapp' => 'nullable|string|max:50',
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'footer_description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string'
        ]);

        $landingPage = LandingPage::firstOrFail();

        if ($request->hasFile('hero_image')) {
            // Delete old image if exists
            if ($landingPage->hero_image) {
                Storage::disk('public')->delete($landingPage->hero_image);
            }
            $validated['hero_image'] = UploadSanitizer::store($request->file('hero_image'), 'landing-page');
        }

        $validated['stats_1'] = $request->filled('stats_1') ? (int) $request->stats_1 : 0;
        $validated['stats_2'] = $request->filled('stats_2') ? (int) $request->stats_2 : 0;
        $validated['stats_3'] = $request->filled('stats_3') ? (int) $request->stats_3 : 0;
        $validated['stats_4'] = $request->filled('stats_4') ? (int) $request->stats_4 : 0;

        $landingPage->update($validated);

        return redirect()->back()->with('success', 'Pengaturan landing page dan statistik capaian dakwah berhasil diperbarui.');
    }
}
