<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlog;
use App\Models\Blog;
use App\Traits\Responses;

class BlogController extends Controller
{
    use Responses;

    public function getBlogs()
    {
        return $this->sendSuccess("Blogs Fetched Successfully", Blog::paginate(30));
    }

    public function createBlog(CreateBlog $request)
    {
        $blog = Blog::create([
            "blog_name" => $request->name
        ]);

        return $this->sendCreated("Blog Created Successfully", $blog);
    }

    public function getSingleBlog(Blog $blog)
    {
        return $this->sendSuccess("Blog Fetched Successfully", $blog);
    }

    public function updateSingleBlog(Blog $blog, CreateBlog $request)
    {
        $blog->update(["blog_name" => $request->name]);

        return $this->sendSuccess("Blog Updated Successfully", $blog);
    }

    public function deleteSingleBlog(Blog $blog)
    {
        $blog->delete();

        return $this->sendSuccess("Blog Deleted Successfully");
    }

}
