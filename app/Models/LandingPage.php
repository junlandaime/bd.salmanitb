<?php

namespace App\Models;

use App\Support\HtmlSanitizer;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'about_title',
        'about_content',
        'mission_title',
        'mission_content',
        'vision_title',
        'vision_content',
        'stats1',
        'stats2',
        'stats3',
        'stats4',
        'stats_1',
        'stats_2',
        'stats_3',
        'stats_4',
        'contact_address',
        'contact_email',
        'contact_phone',
        'contact_whatsapp',
        'social_facebook',
        'social_twitter',
        'social_instagram',
        'social_linkedin',
        'social_youtube',
        'footer_description',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'stats_clients' => 'integer',
        'stats_projects' => 'integer',
        'stats_partners' => 'integer',
    ];

    public function getHeroSubtitleSanitizedAttribute(): string
    {
        return HtmlSanitizer::sanitize($this->hero_subtitle) ?? '';
    }

    public function getAboutContentSanitizedAttribute(): string
    {
        return HtmlSanitizer::sanitize($this->about_content) ?? '';
    }

    public function getMissionContentSanitizedAttribute(): string
    {
        return HtmlSanitizer::sanitize($this->mission_content) ?? '';
    }

    public function getVisionContentSanitizedAttribute(): string
    {
        return HtmlSanitizer::sanitize($this->vision_content) ?? '';
    }

    public function getFooterDescriptionSanitizedAttribute(): string
    {
        return HtmlSanitizer::sanitize($this->footer_description) ?? '';
    }

    public function getMetaDescriptionSanitizedAttribute(): string
    {
        return HtmlSanitizer::sanitize($this->meta_description) ?? '';
    }
}
