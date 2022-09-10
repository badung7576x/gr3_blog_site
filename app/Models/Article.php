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
        'header_thumbnail', 'summary', 'content',
        'publish_schedule', 'publish_time', 'tags', 'status',
        'created_by', 'reviewer_by', 'review_status'
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

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id', 'id');
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
                Carbon::parse($value)->format('H:m d-m-Y');
            },
        );
    }
}
