<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeItem extends Model
{
    protected $fillable = [
        'type',
        'title',
        'subtitle',
        'date_range',
        'description',
        'image_path',
        'sort_order',
        'is_published',
    ];
}
