<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class PublishTemplateTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_can_publish_paper_styled_template(): void
    {
        $category = BlogCategory::firstOrCreate(
            ['slug' => 'clinical-laboratory'],
            ['name' => 'Clinical Laboratory & Diagnostics']
        );

        $payload = json_decode(file_get_contents(base_path('fbs_post_template.json')), true);
        $payload['blog_category_id'] = $category->id;

        $response = $this->postJson('/api/blog/publish?token=blog-publish-a7xK9mQ2pW', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'slug' => 'fasting-blood-sugar-fbs-standard-procedure'
        ]);

        $post = BlogPost::where('slug', 'fasting-blood-sugar-fbs-standard-procedure')->first();
        $this->assertNotNull($post);
        $this->assertStringContainsString('paper-post-body', $post->getTranslation('content', 'en'));
        $this->assertStringContainsString('فحص سكر الصائم', $post->getTranslation('title', 'ar'));
    }
}
