<?php


namespace App\Repositories;


use App\ArticleCategory;
use App\Interfaces\ArticleCategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
class ArticleCategoryRepository implements ArticleCategoryRepositoryInterface
{

    public function all($articleId)
    {
        $articleCategories = ArticleCategory::where('article_id', '=', $articleId)->get();
        $categoryRepository = new CategoryRepository();
        $categories = [];
        foreach ($articleCategories as $articleCategory)
            $categories[] = $categoryRepository->find($articleCategory->category_id);

        return $categories;
    }

    public function show($articleId, $categoryId)
    {
        $categoryRepository = new CategoryRepository();
        $articleCategory = ArticleCategory::where('article_id', '=', $articleId)
            ->where('category_id', '=', $categoryId)->first();

        if($articleCategory == null)
            return null;

        $category = $categoryRepository->find($articleCategory->category_id);

        return $category;
    }

    public function storeArticleCategory($articleId, $categoryId)
    {
        $articleCategory = ArticleCategory::create([
           'article_id' => $articleId,
           'category_id' => $categoryId
        ]);

        return $articleCategory;
    }

    public function deleteArticleCategory($articleId, $categoryId)
    {
        $articleCategory = ArticleCategory::where('article_id', '=', $articleId)->where('category_id', '=', $categoryId)
            ->delete();

        return $articleCategory ? $articleCategory : null;

    }
}
