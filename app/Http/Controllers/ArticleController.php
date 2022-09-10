<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Traits\ResponseTrait;
use App\Models\Article;
use App\Services\ArticleService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    use ResponseTrait;

    protected $categoryService;
    protected $articleService;

    public function __construct(CategoryService $categoryService, ArticleService $articleService)
    {
        $this->categoryService = $categoryService;
        $this->articleService = $articleService;
    }

    public function home()
    {
        return view('user.home');
    }

    public function detail(Article $article)
    {
        if (!$article->is_published) abort(404);
        return view('user.article', compact('article'));
    }

    public function preview(Article $article)
    {
        if (!Gate::allows('can_preview', [$article])) abort(404);

        return view('user.preview', compact('article'));
    }

    public function list()
    {
        $articles = $this->articleService->getAllArticleByUser();

        return view('user.list', compact('articles'));
    }

    public function create()
    {
        $categories = $this->categoryService->getCategoriesWithSession();

        return view('user.create', compact('categories'));
    }

    public function store(CreateArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleService->createNewArticle($data);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->redirectError('Đã xảy ra lỗi trong quá trình lưu bài viết, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('article.list', 'Lưu bài viết thành công');        
    }

    public function edit(Article $article)
    {
        $categories = $this->categoryService->getCategoriesWithSession();

        return view('user.edit', compact('categories', 'article'));
    }

    public function update(Article $article, UpdateArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleService->updateArticle($article, $data);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->redirectError('create', 'Đã xảy ra lỗi trong quá trình lưu bài viết, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('article.list', 'Cập nhật bài viết thành công');        
    }

    public function destroy(Article $article)
    {
        $this->articleService->delete($article);

        return $this->redirectSuccess('article.list', 'Xóa bài viết thành công');  
    }
}
