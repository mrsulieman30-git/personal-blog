<?php

use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Project;

// ── Language Switcher ───────────────────────────────────────
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar', 'so'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// ── Local Storage Workaround for PHP -S ───────────────────────
if (app()->environment('local')) {
    Route::get('storage/{path}', function ($path) {
        $path = storage_path('app/public/' . $path);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path);
    })->where('path', '.*');
}

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/about', function () { 
    $resumeItems = \App\Models\ResumeItem::where('is_published', true)->orderBy('sort_order')->get();
    $experience = $resumeItems->where('type', 'experience');
    $education = $resumeItems->where('type', 'systemic_education');
    $courses = $resumeItems->where('type', 'course');
    $licenses = $resumeItems->whereIn('type', ['license', 'certificate']);
    return view('pages.about', compact('experience', 'education', 'courses', 'licenses')); 
});

Route::get('/coming-soon', function () { return view('pages.coming-soon'); });

// ── Blog Routes ──────────────────────────────────────────────
Route::get('/blog', \App\Livewire\BlogIndex::class)->name('blog.index');
Route::get('/posts', \App\Livewire\BlogIndex::class);
Route::get('/posts/{slug}', \App\Livewire\BlogPostShow::class)->name('blog.show');
Route::get('/blog/{slug}', function ($slug) {
    $post = BlogPost::with(['category', 'comments' => function ($q) {
        $q->where('is_approved', true)->orderBy('created_at', 'desc');
    }])->where('slug', $slug)
      ->where('is_published', true)
      ->firstOrFail();

    $relatedPosts = BlogPost::where('is_published', true)
        ->where('id', '!=', $post->id)
        ->when($post->blog_category_id, fn ($q) => $q->where('blog_category_id', $post->blog_category_id))
        ->orderBy('published_at', 'desc')
        ->take(3)
        ->get();

    return view('pages.blog.show', compact('post', 'relatedPosts'));
})->name('blog.show.legacy');

// ── Projects ─────────────────────────────────────────────────
Route::get('/projects', \App\Livewire\ProjectsIndex::class)->name('projects.index');

// ── Sitemap ──────────────────────────────────────────────────
Route::get('/sitemap.xml', function () {
    $posts = BlogPost::where('is_published', true)->get();
    $projects = Project::where('is_published', true)->get();

    return response()->view('sitemap', [
        'posts' => $posts,
        'projects' => $projects,
    ])->header('Content-Type', 'text/xml');
});

// ── DYNAMIC CMS Catch-All Route ──────────────────────────────
// This MUST be at the very bottom. It catches any URL not defined above.
Route::get('/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();
    return view('pages.dynamic', compact('page'));
})->name('page.show');
