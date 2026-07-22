<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'excerpt', 'content'];

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getDisplayImageAttribute()
    {
        if (!empty($this->featured_image_url)) {
            return $this->featured_image_url;
        }

        if (!empty($this->featured_image)) {
            return asset('storage/' . $this->featured_image);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->title ?? 'Blog') . '&background=6366f1&color=fff&size=800';
    }

    public function category() { return $this->belongsTo(BlogCategory::class, 'blog_category_id'); }
    public function user() { return $this->belongsTo(User::class); }
    public function comments() { return $this->hasMany(BlogComment::class); }
    public function likes() { return $this->hasMany(BlogPostLike::class, 'blog_post_id'); }
}
