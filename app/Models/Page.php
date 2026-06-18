<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property string $slug
 */


class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'ai_prompt',
        'status'
    ];

    protected $casts = [
        'content' => 'array',
    ];
}
