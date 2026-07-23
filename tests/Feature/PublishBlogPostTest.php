<?php

namespace Tests\Feature;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublishBlogPostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Set the env token for testing
        config(['app.blog_publish_token' => 'blog-publish-a7xK9mQ2pW']);
        putenv('BLOG_PUBLISH_TOKEN=blog-publish-a7xK9mQ2pW');
    }

    public function test_unauthorized_token_returns_401(): void
    {
        $response = $this->postJson('/api/blog/publish?token=wrong-token', [
            'title_en' => 'Test title',
            'content_en' => 'Test content',
            'slug' => 'test-slug',
            'excerpt_en' => 'Test excerpt',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['success' => false, 'error' => 'Unauthorized']);
    }

    public function test_can_publish_blog_post_with_valid_token(): void
    {
        $category = BlogCategory::create([
            'name' => 'Category 1',
            'slug' => 'category-1',
        ]);

        $response = $this->postJson('/api/blog/publish?token=blog-publish-a7xK9mQ2pW', [
            'title_en' => 'Test Post English',
            'title_ar' => 'اختبار عربي',
            'title_so' => 'Tijaabo Somali',
            'content_en' => '<p>English Content</p>',
            'content_ar' => '<p>Arabic Content</p>',
            'content_so' => '<p>Somali Content</p>',
            'slug' => 'test-api-post-1',
            'excerpt_en' => 'Excerpt English',
            'excerpt_ar' => 'Excerpt Arabic',
            'excerpt_so' => 'Excerpt Somali',
            'is_published' => true,
            'blog_category_id' => $category->id,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'slug' => 'test-api-post-1',
        ]);

        // Verify database records
        $post = BlogPost::where('slug', 'test-api-post-1')->first();
        $this->assertNotNull($post);

        // Verify translations
        $this->assertEquals('Test Post English', $post->getTranslation('title', 'en'));
        $this->assertEquals('اختبار عربي', $post->getTranslation('title', 'ar'));
        $this->assertEquals('Tijaabo Somali', $post->getTranslation('title', 'so'));

        $this->assertEquals('<p>English Content</p>', $post->getTranslation('content', 'en'));
        $this->assertEquals('<p>Arabic Content</p>', $post->getTranslation('content', 'ar'));
        $this->assertEquals('<p>Somali Content</p>', $post->getTranslation('content', 'so'));

        $this->assertEquals('Excerpt English', $post->getTranslation('excerpt', 'en'));
        $this->assertEquals('Excerpt Arabic', $post->getTranslation('excerpt', 'ar'));
        $this->assertEquals('Excerpt Somali', $post->getTranslation('excerpt', 'so'));

        // Verify regular fields
        $this->assertTrue((bool)$post->is_published);
        $this->assertEquals($category->id, $post->blog_category_id);
    }
}
