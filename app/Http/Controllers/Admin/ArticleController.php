<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateArticleRequest;
use App\Http\Traits\ResponseTrait;
use App\Models\Article;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    use ResponseTrait;

    protected $articleService;
    protected $userService;
    protected $categoryService;

    public function __construct(ArticleService $articleService, UserService $userService, CategoryService $categoryService)
    {
        $this->articleService = $articleService;
        $this->userService = $userService;
        $this->categoryService = $categoryService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleService->getAllArticlesForAdmin();

        return view('admin.articles.index', compact('articles'));
    }

    public function assignments()
    {
        $articles = $this->articleService->getAllArticlesForAssignment();
        $reviewers = $this->userService->getListReviewer();

        return view('admin.articles.assignment', compact('articles', 'reviewers'));
    }

    public function assignReviewer(Request $request)
    {
        $articleIds = $request->get('articles')[0];
        $reviewer = $request->get('reviewer');
        $this->articleService->assign($articleIds, $reviewer);

        return $this->redirectSuccess('admin.article.assignment', 'Bài viết đã được gán cho người đánh giá');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $comments = [];
        return view('admin.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = $this->categoryService->getCategoriesWithSession();
        $reviewers = $this->userService->getListReviewer();

        return view('admin.articles.edit', compact('article', 'categories', 'reviewers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Article $article, AdminUpdateArticleRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleService->adminUpdateArticle($article, $data);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->redirectError('Đã xảy ra lỗi trong quá trình lưu bài viết, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('admin.article.show', 'Cập nhật bài viết thành công', ['article' => $article]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->articleService->delete($article);

        return $this->redirectSuccess('admin.article.index', 'Xóa bài viết thành công'); 
    }
}
