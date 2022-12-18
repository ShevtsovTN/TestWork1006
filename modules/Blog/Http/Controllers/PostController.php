<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Modules\Blog\Http\Requests\CreatePostRequest;
use Modules\Blog\Http\Requests\UpdatePostRequest;
use Modules\Blog\Http\Resources\PostCollection;
use Modules\Blog\Http\Resources\PostResource;
use Modules\Blog\Models\Post;
use Modules\Blog\Services\PostService;

class PostController extends Controller
{
    private PostService $service;

    public function __construct(PostService $postService)
    {
        $this->service = $postService;
    }

    /**
     * @return PostCollection
     */
    public function index(): PostCollection
    {
        return PostCollection::make(
            Post::with('user')
                ->orderByDesc('created_at')
                ->paginate(request('per_page', 5))
        );
    }

    /**
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        return PostResource::make($post->load('user'));
    }

    /**
     * @param CreatePostRequest $createPostRequest
     * @return PostResource
     * @throws Exception
     */
    public function store(CreatePostRequest $createPostRequest): PostResource
    {
        $this->authorize('create', Post::class);
        return PostResource::make($this->service->create($createPostRequest->validated()));
    }

    /**
     * @param Post $post
     * @param UpdatePostRequest $updatePostRequest
     * @return PostResource
     * @throws Exception
     */
    public function update(Post $post, UpdatePostRequest $updatePostRequest): PostResource
    {
        $this->authorize('update', $post);
        return PostResource::make($this->service->update($post, $updatePostRequest->validated()));
    }

    /**
     * @param Post $post
     * @return PostResource
     * @throws Exception
     */
    public function destroy(Post $post): PostResource
    {
        $this->authorize('delete', $post);
        return PostResource::make($this->service->delete($post));
    }
}
