<?php

namespace App\Http\Controllers;

use App\Events\CreatePostEvent;
use App\Events\OrderShipmentStatusUpdated;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Repository\PostRepository;
use App\Http\Requests\CreatePostRequest;
use Error;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class PostController extends Controller
{
    /**
     * PostController constructor.
     * @param PostRepository $postRepo
     */

    public function __construct(protected PostRepository $postRepo)
    {
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */

    public function index()
    {
        return PostResource::collection($this->postRepo->getAll());
    }

    /**
     * @param $post
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($post)
    {
        return response()->json([
            'post' => new PostResource($this->postRepo->getOne($post))
        ]);

    }

    /**
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(CreatePostRequest $request)
    {
        $image = Storage::putFile('public/photos', $request['file']);
        $image = Str::replaceFirst('public', 'storage', $image);
        $data = [
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image
        ];
        $post = $this->postRepo->create($data);
        broadcast(new CreatePostEvent($post));
        return response()->json(['success' => true]);


    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy($id)
    {
        broadcast(new CreatePostEvent($this->postRepo->getOne($id)));
        $this->postRepo->deletePost($id);
        return response()->json(['success' => true]);

    }


    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(UpdateRequest $request, $id)
    {
        $image = Storage::putFile('public/photos', $request['file']);
        $image = Str::replaceFirst('public', 'storage', $image);
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image

        ];

      $this->postRepo->updatePost($data, $id);
//        broadcast(new CreatePostEvent($post));

        return response()->json(['success' => true]);

    }
}
