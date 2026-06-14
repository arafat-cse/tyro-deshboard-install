<?php

namespace App\Http\Controllers\LifeDecode;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::with('blogCategory')->published()->get();
        $categories = BlogCategory::active()->get();
        $featuredPost = $posts->firstWhere('is_featured', true) ?? $posts->first();
        $listPosts = $featuredPost
            ? $posts->where('id', '!=', $featuredPost->id)->values()
            : $posts;

        return view('life-decode.blog', [
            'posts' => $listPosts,
            'featuredPost' => $featuredPost,
            'categories' => $categories->pluck('name'),
            'categoryCounts' => $posts->countBy('category_name'),
            'popularPosts' => $posts->where('is_popular', true)->take(3)->values(),
        ]);
    }

    public function show(BlogPost $blogPost): View
    {
        abort_unless($blogPost->is_published, 404);

        $blogPost->load('blogCategory');

        return view('life-decode.blog-show', [
            'post' => $blogPost,
            'relatedPosts' => BlogPost::with('blogCategory')
                ->published()
                ->whereKeyNot($blogPost->id)
                ->where('blog_category_id', $blogPost->blog_category_id)
                ->limit(3)
                ->get(),
        ]);
    }
}
