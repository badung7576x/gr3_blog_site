<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'articles';

    protected $fillable = [
        'slug', 'title', 'category_id', 'session_id',
        'header_thumbnail', 'summary', 'content', 'pdf', 'attachment',
        'publish_schedule', 'publish_time', 'tags', 'status',
        'created_by', 'review_by', 'review_status', 'is_published'
    ];

    protected $appends = [
        'list_tags',
        'publish_time_label'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (auth()->user()) {
                $model->created_by = auth()->user()->id;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function reviewBy()
    {
        return $this->belongsTo(User::class, 'review_by', 'id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'id');
    }

    public function listTags(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return explode(',', $attributes['tags']);
            },
        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return Carbon::parse($value)->format('H:i d/m/Y');
            },
        );
    }

    public function publishTimeLabel(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return Carbon::parse($attributes['publish_time'])->format('H:i d/m/Y');
            },
        );
    }
}
