<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Tag;

class AdminTagController extends Controller
{
    public function index() {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    public function createPage() {
        return view('admin.tags.create');
    }

    public function delete(Tag $tag) {
        $tag->delete();

        return redirect()->route('admin.tag.index');
    }

    public function editPage(Tag $tag) {
        return view('admin.tags.edit', compact('tag'));
    }

    public function show(Tag $tag) {
        return view('admin.tags.show', compact('tag'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        Tag::firstOrCreate($data);

        return redirect()->route('admin.tag.index');
    }

    public function update(UpdateRequest $request, Tag $tag) {
        $data = $request->validated();
        $tag->update($data);

        return view('admin.tags.show', compact('tag'));
    }
}
