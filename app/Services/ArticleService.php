<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Session;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleService
{

  public function getAllArticleByUser()
  {
    $currentUser = auth()->user();

    return Article::where('created_by', $currentUser->id)->latest()->get();
  }

  public function getRelatedArticles(Article $article)
  {
    $now = Carbon::now()->toDateString();

    $sessionIds = Session::where('start_time', '<=', $now)->where('end_time', '>=', $now)->pluck('id')->all();

    return Article::where('is_published', true)
      ->where('id', '!=', $article->id)
      ->where('status', ARTICLE_ACCEPTED)
      ->where('publish_time', '<=', $now)
      ->where(function($query) use ($article) {
        return $query->where('category_id', $article->category_id)
          ->orWhere('created_by', $article->created_by);
      })
      ->whereIn('session_id', $sessionIds)->get();
  }

  public function getAllForHomepage(Request $request)
  {
    $keyword = $request->get('keyword');
    $category = $request->get('category');

    $now = Carbon::now()->toDateString();

    $sessionIds = Session::where('start_time', '<=', $now)->where('end_time', '>=', $now)->pluck('id')->all();

    $query = Article::where('is_published', true)
      ->where('status', ARTICLE_ACCEPTED)
      ->where('publish_time', '<=', $now)
      ->whereIn('session_id', $sessionIds);

    if($keyword) {
      $query = $query->where('title', 'like', '%' . $keyword . '%');
    }

    if($category) {
      $query = $query->where('category_id', $category);
    }

    return $query->orderBy('publish_time', 'desc')->get();
  }

  public function getAllArticlesForAdmin()
  {
    return Article::latest()->get();
  }

  public function getAllArticlesForAssignment()
  {
    return Article::where('status', ARTICLE_CREATED)->whereNull('review_by')->latest()->get();
  }

  public function getAllArticlesForReview()
  {
    return Article::where('review_by', auth()->user()->id)->orderBy('review_status', 'asc')->get();
  }

  public function createNewArticle(array $data)
  {
    if (isset($data['image'])) {
      $uploadImageService = new UploadImageService();
      $data['header_thumbnail'] = $uploadImageService->upload($data['image']->get())['url'];
    }

    if (isset($data['pdf'])) {
      $fileName = $data['pdf']->getClientOriginalName();
      $data['attachment'] = Storage::put('attachments', $data['pdf']);
      $data['pdf'] = $fileName;
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

    if (isset($data['remove_pdf']) && $data['remove_pdf'] == 1) {
      if($article->attachment) Storage::delete($article->attachment);
      $data['attachment'] = $data['pdf'] = null;
    }

    if (isset($data['pdf'])) {
      if($article->attachment) Storage::delete($article->attachment);
      $fileName = $data['pdf']->getClientOriginalName();
      $data['attachment'] = Storage::put('attachments', $data['pdf']);
      $data['pdf'] = $fileName;
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

    if (isset($data['remove_pdf']) && $data['remove_pdf'] == 1) {
      if($article->attachment) Storage::delete($article->attachment);
      $data['attachment'] = $data['pdf'] = null;
    }

    if (isset($data['pdf'])) {
      if($article->attachment) Storage::delete($article->attachment);
      $fileName = $data['pdf']->getClientOriginalName();
      $data['attachment'] = Storage::put('attachments', $data['pdf']);
      $data['pdf'] = $fileName;
    }

    $cateSession = explode('_', $data['session_id']);
    $data['category_id'] = $cateSession[0];
    $data['session_id'] = $cateSession[1];

    return $article->update($data);
  }

  public function reviewerUpdateArticle(Article $article, array $data)
  {
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

  public function getAllCommentForArticle(Article $article)
  {
    return Comment::where('article_id', $article->id)->latest()->get();
  }
}
