<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepository = $categoryRepositoryInterface;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();

        return count($categories) >= 1 ? response($categories, 200) :
            response(['message' => "No categories found in Blog"], 404);
    }

    public function show($categoryId)
    {
        $category = $this->categoryRepository->find($categoryId);

        return $category ? response($category, 200) : response(['message' => 'Given category not found'], 404);
    }

    public function subCategories($categoryId)
    {
        $categories = $this->categoryRepository->getSubCategories($categoryId);

        return count($categories) >= 1 ? response($categories, 200) :
            response(['message' => "No Sub-categories found"], 404);
    }

    public function store(Request $request)
    {
        $validatedRequest = $this->validator($request);

        return $this->categoryRepository->storeCategory($validatedRequest) ?
            response(['message' => 'Category added successfully'], 201) :
            response(['message' => 'Category does not added'], 401);
    }

    public function update(Request $request, $categoryId)
    {
        $validatedRequest = $this->validator($request);

        return $this->categoryRepository->updateCategory($validatedRequest, $categoryId) ?
            response(['message' => 'Category updated successfully'], 201):
            response(['message' => 'Category not found'], 404);
    }

    public function destroy($categoryId)
    {
        return $this->categoryRepository->deleteCategory($categoryId) ?
            response(['message' => 'Category deleted successfully'], 201):
            response(['message' => 'Category not found'], 404);
    }

    public function validator(Request $request)
    {
        return $this->validate($request, [
           'parent_id' => 'integer|min:1|exists:categories,id|nullable',
           'name' => 'string|required'
        ]);
    }
}
