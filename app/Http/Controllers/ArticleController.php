<?php

namespace App\Http\Controllers;

use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller {

    private $articlesRepository;

    public function __construct(ArticleRepositoryInterface $articleRepositoryInterface)
    {
        $this->articlesRepository = $articleRepositoryInterface;
    }

    public function index()
    {
        $articles = $this->articlesRepository->all();

        return count($articles) >= 1 ? response($articles, 200) :
            response(['message' => "No articles found in Blog"], 404);
    }

    public function show($articleId)
    {
        $article = $this->articlesRepository->find($articleId);

        return $article ? response($article, 200) : response(['message' => 'Given article not found'], 404);
    }

    public function userArticles($userId)
    {
        $articles = $this->articlesRepository->getUserArticles($userId);

        return count($articles) >= 1 ? response($articles, 200) : response(['message' => 'No articles found'], 404);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedRequest = $this->validator($request);

        return $this->articlesRepository->storeArticle($validatedRequest, $user->id) ?
            response(['message' => 'Article added successfully'], 201) :
            response(['message' => 'User not found'], 404);
    }

    public function update(Request $request, $articleId)
    {
        $article = $this->articlesRepository->find($articleId);
        if(Gate::denies('update', $article))
            return response(['message' => 'Unauthorized'], 401);

        $validatedRequest = $this->validator($request);

        return $this->articlesRepository->updateArticle($validatedRequest, $articleId) ?
            response(['message' => 'Article updated successfully'], 201):
            response(['message' => 'Article not found'], 404);
    }

    public function destroy($articleId)
    {
        $article = $this->articlesRepository->find($articleId);

        if(Gate::denies('delete', $article))
            return response(['message' => 'Unauthorized'], 401);

        return $this->articlesRepository->deleteArticle($articleId) ?
            response(['message' => 'Article deleted successfully'], 201):
            response(['message' => 'Article not found'], 404);

    }

    public function validator(Request $request)
    {
        return $this->validate($request, [
            'title'   => 'string|required',
            'body'    => 'string|required'
        ]);
    }

}
