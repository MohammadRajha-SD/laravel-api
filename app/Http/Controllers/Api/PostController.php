<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class PostController extends Controller
{
    use ApiResponse;
    public function index(){
        $posts = PostResource::collection(Post::all());

        return $this->ApiResponseTrait($posts, 'ok', 200);
    }

    public function show($id){
        $post = Post::find($id);

        if ($post){
            return $this->ApiResponseTrait(new PostResource($post), 'ok', 200);
        }

        return $this->ApiResponseTrait(null, 'The Post Not Found', 404);
    }
    public function store(Request $request){

        $validate = Validator::make($request->all(), [
            'title' => ['reqired', 'max:255'],
            'body' => ['reqired', 'max:255'],
        ]);

        if($validate->fails()){
            return $this->ApiResponseTrait(null, $validate->errors(), 400);
        }

        $post = Post::create($request->all());
        
        if ($post){
            return $this->ApiResponseTrait(new PostResource($post), 'The Post Created Successfully.', 201);
        }

        return $this->ApiResponseTrait(null, 'The Post Not Created', 400);
    }

    public function update(Request $request, $id){

        $validate = Validator::make($request->all(), [
            'title' => ['reqired', 'max:255'],
            'body' => ['reqired', 'max:255'],
        ]);

        if($validate->fails()){
            return $this->ApiResponseTrait(null, $validate->errors(), 400);
        }

        $post = Post::find($id);
        
        if(!$post){
            return $this->ApiResponseTrait(null, 'The Post Not Found', 400);
        }
        
        $post->update($request->all());
        
        return $this->ApiResponseTrait(new PostResource($post), 'The Post Updated Successfully.', 201);
    }

    public function destroy($id){
        $post = Post::find($id);
        
        if(!$post){
            return $this->ApiResponseTrait(null, 'The Post Not Found', 400);
        }

        $post->delete($id);

        return $this->ApiResponseTrait(null, 'The Post Deleted Successfully', 200);

    }
}
