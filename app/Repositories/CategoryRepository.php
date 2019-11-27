<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Category;

class CategoryRepository implements CategoryRepositoryInterface {

    public function all()
    {
        $categories = Category::all();

        return $categories;
    }

    public function find($categoryId)
    {
        $category = Category::find($categoryId);

        return $category;
    }

    public function getArticleCategories($articleId)
    {
        // TODO: Implement getArticleCategories() method.
    }

    public function getSubCategories($categoryId)
    {
        $subCategories = Category::where('parent_id', '=', $categoryId)->get();

        return $subCategories;
    }

    public function storeCategory($validatedRequest)
    {
        $category = Category::create($validatedRequest);

        return $category;
    }

    public function updateCategory($validatedRequest, $categoryId)
    {
        $category = $this->find($categoryId);

        return $category ? $category->update($validatedRequest) : null;
    }

    public function deleteCategory($categoryId)
    {
        $category = $this->find($categoryId);

        return $category ? $category->delete() : null;
    }
}
