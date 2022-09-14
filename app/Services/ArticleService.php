<?php

namespace App\Services;

use App\Models\Article;
use Exception;
use Illuminate\Support\Facades\DB;

class ArticleService
{

  public function getAllArticleByUser()
  {
    $currentUser = auth()->user();

    return Article::where('created_by', $currentUser->id)->latest()->get();
  }

  public function getAllArticlesForAdmin()
  {
    return Article::latest()->get();
  }

  public function getAllArticlesForAssignment()
  {
    return Article::where('status', ARTICLE_CREATED)->whereNull('review_by')->latest()->get();
  }

  public function createNewArticle(array $data)
  {
    if (isset($data['image'])) {
      $uploadImageService = new UploadImageService();
      $data['header_thumbnail'] = $uploadImageService->upload($data['image']->get())['url'];
    }

    $cateSession = explode('_', $data['session_id']);
    $data['category_id'] = $cateSession[0];
    $data['session_id'] = $cateSession[1];
    $data['status'] = ARTICLE_CREATED;

    return Article::create($data);
  }

  public function updateArticle(Article $article, array $data)
  {
    if (isset($data['image'])) {
      $uploadImageService = new UploadImageService();
      $data['header_thumbnail'] = $uploadImageService->upload($data['image']->get())['url'];
    }

    $cateSession = explode('_', $data['session_id']);
    $data['category_id'] = $cateSession[0];
    $data['session_id'] = $cateSession[1];

    return $article->update($data);
  }

  public function adminUpdateArticle(Article $article, array $data)
  {
    if (isset($data['image'])) {
      $uploadImageService = new UploadImageService();
      $data['header_thumbnail'] = $uploadImageService->upload($data['image']->get())['url'];
    }

    $cateSession = explode('_', $data['session_id']);
    $data['category_id'] = $cateSession[0];
    $data['session_id'] = $cateSession[1];

    return $article->update($data);
  }

  public function delete(Article $article)
  {
    return $article->delete();
  }

  public function assign(string $articles, $reviewer_id)
  {
    $articles = explode(',', $articles);
    try {
      DB::beginTransaction();
      Article::whereIn('id', $articles)->update([
        'review_by' => $reviewer_id,
        'status' => ARTICLE_WAITING_REVIEW
      ]);
      DB::commit();
    } catch (Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }
}
