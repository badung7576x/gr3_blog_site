<?php

namespace App\Services;

use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

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

  public function createCategory(array $data)
  {
    DB::beginTransaction();
    try {
      $category = Category::create([
        'name' => $data['name'],
        'description' => $data['name']
      ]);

      for ($i = 0; $i < MAX_SESSIONS; $i++) {
        if ($data['session_name'][$i] && $data['session_start'][$i] && $data['session_end'][$i] ) {
          $category->sessions()->create([
            'session_name' => $data['session_name'][$i],
            'start_time' => $data['session_start'][$i],
            'end_time' => $data['session_end'][$i],
          ]);
        }
      }
      DB::commit();
    } catch (Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

}