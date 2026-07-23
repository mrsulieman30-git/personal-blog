<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\BlogPost;

Route::post('/blog/publish', function (Request $request) {
    // Simple token auth
    $token = $request->query('token', '');
    $secretToken = config('app.blog_publish_token') ?? env('BLOG_PUBLISH_TOKEN');
    if (empty($secretToken) || $token !== $secretToken) {
        return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
    }
    
    // Validate
    $data = $request->validate([
        'title_en' => 'required|string|max:255',
        'title_ar' => 'nullable|string|max:255',
        'title_so' => 'nullable|string|max:255',
        'content_en' => 'required|string',
        'content_ar' => 'nullable|string',
        'content_so' => 'nullable|string',
        'slug' => 'required|string|max:255|unique:blog_posts,slug',
        'excerpt_en' => 'required|string|max:255',
        'excerpt_ar' => 'nullable|string|max:255',
        'excerpt_so' => 'nullable|string|max:255',
        'is_published' => 'nullable|boolean',
        'blog_category_id' => 'nullable|integer|exists:blog_categories,id',
        'featured_image_url' => 'nullable|url|max:2048',
    ]);
    
    try {
        $post = new BlogPost();
        
        // Set translatable fields
        $post->setTranslation('title', 'en', $data['title_en']);
        if (!empty($data['title_ar'])) {
            $post->setTranslation('title', 'ar', $data['title_ar']);
        }
        if (!empty($data['title_so'])) {
            $post->setTranslation('title', 'so', $data['title_so']);
        }
        
        $post->setTranslation('content', 'en', $data['content_en']);
        if (!empty($data['content_ar'])) {
            $post->setTranslation('content', 'ar', $data['content_ar']);
        }
        if (!empty($data['content_so'])) {
            $post->setTranslation('content', 'so', $data['content_so']);
        }
        
        $post->setTranslation('excerpt', 'en', $data['excerpt_en']);
        if (!empty($data['excerpt_ar'])) {
            $post->setTranslation('excerpt', 'ar', $data['excerpt_ar']);
        }
        if (!empty($data['excerpt_so'])) {
            $post->setTranslation('excerpt', 'so', $data['excerpt_so']);
        }
        
        // Set regular fields
        $post->slug = $data['slug'];
        $post->is_published = $data['is_published'] ?? true;
        if (!empty($data['blog_category_id'])) {
            $post->blog_category_id = $data['blog_category_id'];
        }
        if (!empty($data['featured_image_url'])) {
            $post->featured_image_url = $data['featured_image_url'];
        }
        
        $post->save();
        
        return response()->json([
            'success' => true,
            'id' => $post->id,
            'slug' => $post->slug,
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
});
