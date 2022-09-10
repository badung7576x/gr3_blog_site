<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Traits\ResponseTrait;
use App\Models\Article;
use App\Services\ArticleService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Log;

class ArticlesController extends Controller
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
        return view('user.article', compact('article'));
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
            return $this->redirectError('create', 'Đã xảy ra lỗi trong quá trình lưu bài viết, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('article.list', 'Lưu bài viết thành công');        
    }

    public function edit(Article $article)
    {
        $categories = $this->categoryService->getCategoriesWithSession();

        return view('user.edit', compact('categories', 'article'));
    }

    public function update(CreateArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleService->createNewArticle($data);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->redirectError('create', 'Đã xảy ra lỗi trong quá trình lưu bài viết, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('article.list', 'Lưu bài viết thành công');        
    }

    public function destroy(Article $article)
    {
        $this->articleService->delete($article);

        return $this->redirectSuccess('article.list', 'Xóa bài viết thành công');  
    }
}
