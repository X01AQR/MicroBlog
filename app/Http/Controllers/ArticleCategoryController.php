<?php


namespace App\Http\Controllers;
use App\Interfaces\ArticleCategoryRepositoryInterface;
use Illuminate\Http\Request;


class ArticleCategoryController extends Controller
{
    private $articleCategoryRepository;

    public function __construct(ArticleCategoryRepositoryInterface $articleCategoryRepositoryInterface)
    {
        $this->articleCategoryRepository = $articleCategoryRepositoryInterface;
    }

    public function index($articleId)
    {
        $categories = $this->articleCategoryRepository->all($articleId);

        return count($categories) >= 1 ? response($categories, 200) :
            response(['message' => 'The article has not categories'], 404);
    }

    public function show($articleId, $categoryId)
    {
        $category = $this->articleCategoryRepository->show($articleId, $categoryId);

        return $category ? response($category, 200) : response(['message' => 'Article category not found'], 404);
    }

    public function store($articleId, $categoryId)
    {

        $articleCategory = $this->articleCategoryRepository->storeArticleCategory($articleId, $categoryId);

        return $articleCategory ? response(['message' => 'Article Category added successfully'], 201) :
            response(['message' => 'Article or Category not found'], 404);
    }

    public function destroy($articleId, $categoryId)
    {
        return $this->articleCategoryRepository->deleteArticleCategory($articleId, $categoryId) ?
            response(['message' => 'Article Category deleted successfully'], 201) :
            response(['message' => 'Article or Category not found'], 404);
    }

}
