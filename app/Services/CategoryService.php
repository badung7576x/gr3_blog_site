<?php

namespace App\Services;

use App\Models\Category;

class CategoryService 
{
  public function getCategoriesWithSession()
  {
    return Category::with('sessions')->latest()->get();
  }

}