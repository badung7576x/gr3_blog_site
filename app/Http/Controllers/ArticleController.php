<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Traits\ResponseTrait;
use App\Models\Article;
use App\Models\User;
use App\Services\ArticleService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $articles = $this->articleService->getAllArticleByUser();

        return view('public.user.list', compact('articles'));
    }

    public function home(Request $request)
    {
        $articles = $this->articleService->getAllForHomepage($request);

        return view('public.home', compact('articles'));
    }

    public function preview(Article $article)
    {
        if (!Gate::allows('can_preview', [$article])) abort(404);

        return view('public.user.preview', compact('article'));
    }

    public function detail(Article $article)
    {
        if (!$article->is_published && !Gate::allows('can_preview', [$article])) abort(404);
        $article->load('createdBy');
        $relatedArticles = $this->articleService->getRelatedArticles($article);

        return view('public.detail', compact('article', 'relatedArticles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getCategoriesWithSession();

        return view('public.user.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleService->createNewArticle($data);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->redirectError('Đã xảy ra lỗi trong quá trình lưu bài viết, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('article.index', 'Lưu bài viết thành công', ['username' => auth()->user()->username]);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Article $article)
    {
        $comments = $this->articleService->getAllCommentForArticle($article);

        return view('public.user.detail', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Article $article)
    {
        $categories = $this->categoryService->getCategoriesWithSession();

        return view('public.user.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Article $article, UpdateArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleService->updateArticle($article, $data);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->redirectError('Đã xảy ra lỗi trong quá trình lưu bài viết, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('article.index', 'Cập nhật bài viết thành công', ['username' => auth()->user()->username]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Article $article)
    {
        $this->articleService->delete($article);

        return $this->redirectSuccess('article.index', 'Xóa bài viết thành công', ['username' => auth()->user()->username]);  
    }
}
