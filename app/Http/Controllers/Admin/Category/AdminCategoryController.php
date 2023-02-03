<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function createPage() {
        return view('admin.categories.create');
    }

    public function delete(Category $category) {
        $category->delete();

        return redirect()->route('admin.category.index');
    }

    public function editPage(Category $category) {
        return view('admin.categories.edit', compact('category'));
    }

    public function show(Category $category) {
        return view('admin.categories.show', compact('category'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        Category::firstOrCreate($data);

        return redirect()->route('admin.category.index');
    }

    public function update(UpdateRequest $request, Category $category) {
        $data = $request->validated();
        $category->update($data);

        return view('admin.categories.show', compact('category'));
    }
}
