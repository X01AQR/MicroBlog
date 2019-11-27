<?php

namespace App\Interfaces;

interface ArticleRepositoryInterface {
    public function all();
    public function find($articleId);
    public function getUserArticles($userId);
    public function storeArticle($validatedRequest, $userId);
    public function updateArticle($validatedRequest, $articleId);
    public function deleteArticle($articleId);

}
