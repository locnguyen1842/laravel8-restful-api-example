<?php

namespace App\Services;

use App\ModelFilters\PostFilter;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostService {

    private $postRepo;

    public function __construct(PostRepositoryInterface $postRepo) {
        $this->postRepo = $postRepo;
    }

    public function all(Request $request)
    {
        $posts = $this->postRepo->modelFilter(PostFilter::class, $request->all())->paginate($request->size);
        return $posts;
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validated();
        return $this->postRepo->create($validatedData);
    }
    
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validated();
        return $this->postRepo->update($validatedData, $post->id);
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}