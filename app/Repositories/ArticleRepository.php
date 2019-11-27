<?php

namespace App\Repositories;
use App\Article;

use App\Interfaces\ArticleRepositoryInterface;
use App\Repositories\UserRepository;

class ArticleRepository implements ArticleRepositoryInterface {

    public function all()
    {
        $articles = Article::all();

        return $articles;
    }

    public function find($articleId)
    {
        $article = Article::find($articleId);

        return $article;
    }

    public function getUserArticles($userId)
    {
        $articles = Article::where('user_id', '=', $userId)->get();

        return $articles;
    }

    public function storeArticle($validatedRequest)
    {
        $article = Article::create($validatedRequest);

        return $article;
    }

    public function updateArticle($validatedRequest, $articleId)
    {
        $article = $this->find($articleId);

        return $article ? $article->update($validatedRequest) : null;
    }

    public function deleteArticle($articleId)
    {
        $article = $this->find($articleId);

        return $article ? $article->delete() : null;
    }

}
