<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Article;
use App\Models\News;
use App\Models\Program;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = App::make('sitemap');

        // Add static routes
        $sitemap->add(URL::to('/'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(URL::to('/programs'), Carbon::now(), '0.9', 'weekly');
        $sitemap->add(URL::to('/activities'), Carbon::now(), '0.9', 'weekly');
        $sitemap->add(URL::to('/services'), Carbon::now(), '0.8', 'weekly');
        $sitemap->add(URL::to('/articles'), Carbon::now(), '0.8', 'weekly');
        $sitemap->add(URL::to('/news'), Carbon::now(), '0.8', 'weekly');
        $sitemap->add(URL::to('/contact'), Carbon::now(), '0.7', 'monthly');

        // Add dynamic routes for Programs
        $programs = Program::all();
        foreach ($programs as $program) {
            $sitemap->add(
                URL::to('/programs/' . $program->slug),
                $program->updated_at,
                '0.8',
                'weekly'
            );
        }

        // Add dynamic routes for Activities
        $activities = Activity::all();
        foreach ($activities as $activity) {
            $sitemap->add(
                URL::to('/activities/' . $activity->slug),
                $activity->updated_at,
                '0.8',
                'weekly'
            );
        }

        // Add dynamic routes for Services
        $services = Service::all();
        foreach ($services as $service) {
            $sitemap->add(
                URL::to('/services/' . $service->slug),
                $service->updated_at,
                '0.7',
                'weekly'
            );
        }

        // Add dynamic routes for Articles
        $articles = Article::all();
        foreach ($articles as $article) {
            $sitemap->add(
                URL::to('/articles/' . $article->slug),
                $article->updated_at,
                '0.7',
                'weekly'
            );
        }

        // Add dynamic routes for News
        $news = News::all();
        foreach ($news as $newsItem) {
            $sitemap->add(
                URL::to('/news/' . $newsItem->slug),
                $newsItem->updated_at,
                '0.7',
                'daily'
            );
        }

        // Generate sitemap
        return $sitemap->render('xml');
    }
}
