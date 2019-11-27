<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface {
    public function all();
    public function find($categoryId);
    public function getArticleCategories($articleId);
    public function getSubCategories($categoryId);
    public function storeCategory($validatedRequest);
    public function updateCategory($validatedRequest, $categoryId);
    public function deleteCategory($categoryId);

}
