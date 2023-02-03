<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class AdminPostController extends BaseController
{
    public function index() {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    public function createPage() {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.users.create', compact('categories', 'tags'));
    }

    public function delete(Post $post) {
        $post->delete();

        return redirect()->route('admin.post.index');
    }

    public function editPage(Post $post) {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    public function show(Post $post) {
        return view('admin.posts.show', compact('post'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        $this->service->store($data);

        return redirect()->route('admin.post.index');
    }

    public function update(UpdateRequest $request, Post $post) {
        $data = $request->validated();
        $post = $this->service->update($data, $post);

        return view('admin.posts.show', compact('post'));
    }

}
