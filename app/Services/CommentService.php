<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Comment;

class CommentService 
{
  public function create(Article $article, array $data)
  {
    $commentData = [
      'content' => $data['new_comment']
    ];
    return $article->comments()->create($commentData);
  }

  public function update(Comment $comment, array $data)
  {
    $commentData = [
      'content' => $data['comment']
    ];
    $comment->update($commentData);
  }

  public function delete(Comment $comment)
  {
    $comment->delete();
  }

}