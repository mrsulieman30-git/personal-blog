<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $guarded = [];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function getTechnologiesAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_string($value) && !empty($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return $decoded;
            }
            return array_map('trim', explode(',', $value));
        }
        return [];
    }

    public function getDisplayImageAttribute()
    {
        if (!empty($this->featured_image)) {
            return asset('storage/' . $this->featured_image);
        }

        if (!empty($this->url)) {
            // Completely free and reliable WordPress MShots API for website screenshots
            return 'https://s0.wp.com/mshots/v1/' . urlencode($this->url) . '?w=1280';
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->title) . '&background=6366f1&color=fff&size=800';
    }

    public function getCanIframeAttribute()
    {
        if (empty($this->url)) {
            return false;
        }

        return cache()->remember('project_iframeable_' . $this->id, 86400, function () {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(3.5)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    ])
                    ->withOptions(['verify' => false])
                    ->get($this->url);

                if (!$response->successful()) {
                    return false;
                }

                $xFrame = $response->header('X-Frame-Options');
                $csp = $response->header('Content-Security-Policy');

                if (!empty($xFrame)) {
                    $cleaned = strtolower(str_replace(' ', '', $xFrame));
                    if ($cleaned === 'sameorigin' || $cleaned === 'deny') {
                        return false;
                    }
                }

                if (!empty($csp)) {
                    $cspLower = strtolower($csp);
                    if (strpos($cspLower, 'frame-ancestors') !== false) {
                        if (strpos($cspLower, "frame-ancestors 'self'") !== false || strpos($cspLower, "frame-ancestors none") !== false) {
                            return false;
                        }
                    }
                }

                return true;
            } catch (\Exception $e) {
                return false;
            }
        });
    }
}
