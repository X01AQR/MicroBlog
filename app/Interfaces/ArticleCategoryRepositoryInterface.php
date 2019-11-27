<?php
namespace App\Interfaces;

interface ArticleCategoryRepositoryInterface {

    public function all($articleId);
    public function show($articleId, $categoryId);
    public function storeArticleCategory($articleId, $categoryId);
    public function deleteArticleCategory($articleId, $categoryId);
}
