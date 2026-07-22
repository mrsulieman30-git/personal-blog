<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Convert blog_posts text fields to JSON map
        DB::table('blog_posts')->orderBy('id')->chunk(100, function ($posts) {
            foreach ($posts as $post) {
                // Ensure we don't double encode if already JSON
                $title = $this->toJsonTranslation($post->title);
                $excerpt = $this->toJsonTranslation($post->excerpt);
                $content = $this->toJsonTranslation($post->content);

                DB::table('blog_posts')->where('id', $post->id)->update([
                    'title' => $title,
                    'excerpt' => $excerpt,
                    'content' => $content,
                ]);
            }
        });

        // 2. Convert projects text fields to JSON map
        DB::table('projects')->orderBy('id')->chunk(100, function ($projects) {
            foreach ($projects as $project) {
                $title = $this->toJsonTranslation($project->title);
                $description = $this->toJsonTranslation($project->description);

                DB::table('projects')->where('id', $project->id)->update([
                    'title' => $title,
                    'description' => $description,
                ]);
            }
        });
    }

    private function toJsonTranslation($value)
    {
        if (empty($value)) return null;

        // Check if it's already a JSON string (e.g., {"en":"..."})
        if (is_string($value) && str_starts_with(trim($value), '{')) {
            json_decode($value);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $value;
            }
        }

        // Convert plain string to JSON translation structure with 'en' as default
        return json_encode(['en' => $value]);
    }

    public function down(): void
    {
        // To reverse, we extract the 'en' value from the JSON string
        DB::table('blog_posts')->orderBy('id')->chunk(100, function ($posts) {
            foreach ($posts as $post) {
                DB::table('blog_posts')->where('id', $post->id)->update([
                    'title' => $this->toPlainString($post->title),
                    'excerpt' => $this->toPlainString($post->excerpt),
                    'content' => $this->toPlainString($post->content),
                ]);
            }
        });

        DB::table('projects')->orderBy('id')->chunk(100, function ($projects) {
            foreach ($projects as $project) {
                DB::table('projects')->where('id', $project->id)->update([
                    'title' => $this->toPlainString($project->title),
                    'description' => $this->toPlainString($project->description),
                ]);
            }
        });
    }

    private function toPlainString($value)
    {
        if (empty($value)) return null;

        if (is_string($value) && str_starts_with(trim($value), '{')) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded['en'] ?? (reset($decoded) ?: '');
            }
        }
        return $value;
    }
};
