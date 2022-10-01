<?php

namespace App\Services;

use App\Models\Category;
use Carbon\Carbon;

class CategoryService 
{
  public function getCategoriesWithSession()
  {
    $now = Carbon::now()->toDateString();

    return Category::with(['sessions' => function($query) use ($now){
      $query->where('start_time', '<=', $now)->where('end_time', '>=', $now);
    }])->latest()->get();
  }

  public function getAllCategories()
  {
    return Category::with('sessions')->latest()->get();
  }

  public function delete(Category $category)
  {
    return $category->delete();
  }

}