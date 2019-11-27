<?php

namespace App\Interfaces;

interface ArticleRepositoryInterface {
    public function all();
    public function find($userId);
    public function getUserArticles($userId);
    public function storeArticle($validatedRequest);
    public function updateArticle($validatedRequest, $articleId);
    public function deleteArticle($articleId);

}
