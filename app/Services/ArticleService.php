<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{

  public function getAllArticleByUser()
  {
    $currentUser = auth()->user();

    return Article::where('created_by', $currentUser->id)->latest()->get();
  }

  public function getAllArticlesForAdmin()
  {
    return Article::where('status', '>=', ARTICLE_CREATED)->latest()->get();
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

  public function delete(Article $article)
  {
    return $article->delete();
  }
}
