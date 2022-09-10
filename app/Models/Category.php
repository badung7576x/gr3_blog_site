<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class, 'category_id', 'id');
    }
}
