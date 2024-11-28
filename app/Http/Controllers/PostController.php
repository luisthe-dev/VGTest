<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogPost;
use App\Models\Blog;
use App\Models\Post;
use App\Traits\Responses;

class PostController extends Controller
{
    use Responses;

    public function getBlogPosts(Blog $blog)
    {
        return $this->sendSuccess("Blog Posts Fetched Successfully", $blog->posts()->paginate(30));
    }

    public function createBlogPost(Blog $blog, CreateBlogPost $request)
    {

        $imagePath = $request->file('cover_image')->store("post_image", 'public');

        $post = $blog->posts()->create([
            "post_title" => $request->title,
            "post_cover_image" => $imagePath,
            "post_content" => $request->content
        ]);

        return $this->sendCreated("Blog Post Created Successfully", $post);
    }

    public function getSinglePost(Post $post)
    {
        return $this->sendSuccess("Post Created Successfully", $post);
    }

    public function updateSinglePost(Post $post, CreateBlogPost $request)
    {

        $post->update([
            "post_title" => $request->title,
            "post_content" => $request->content
        ]);

        return $this->sendSuccess("Post Updated Successfully", $post);
    }

    public function deleteSinglePost(Post $post)
    {

        $post->delete();
        return $this->sendSuccess("Post Deleted Successfully");
    }

}
