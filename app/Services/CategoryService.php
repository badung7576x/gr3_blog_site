<?php

namespace App\Services;

use App\Models\Category;
use Carbon\Carbon;

class CategoryService 
{
  public function getCategoriesWithSession()
  {
    $now = Carbon::now()->format('Y-m-d H:i:s');

    return Category::with(['sessions' => function($query) use ($now){
      $query->where('start_time', '<=', $now)->where('end_time', '>=', $now);
    }])->latest()->get();
  }

}