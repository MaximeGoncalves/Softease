<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    /**
     * Display view in front website
     *
     */
    public function blog()
    {
        $posts = Post::where('online', 1)->orderBY('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        $latests = Post::where('online', 1)->limit(3)->latest()->get();
        return view('blog.index', compact('posts', 'latests', 'categories'));
    }

    public function category($id)
    {
        $posts = Post::where('category_id', $id)->where('online', 1)->paginate(5);
        $categories = Category::all();
        $latests = Post::where('online', 1)->limit(3)->latest()->get();
        return view('blog.index', compact('posts', 'latests', 'categories'));
    }

    public function article($id)
    {
        $post = Post::where('id', $id)->first();
        $comments = Comment::where('post_id', $id)->paginate(5);
        $categories = Category::all();
        $latests = Post::limit(3)->latest()->get();
        return view('blog.show', compact('post', 'latests', 'categories', 'comments'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.blog.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.blog.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = Category::where('id', $request->category)->first();
        $category = $cat->name;
        $file = $request->file('img');

        $article = new Post();
        $article->title = $request->title;

        if (!file_exists(public_path() . '/app/Blog/' . $category)):
            mkdir(public_path() . '/app/Blog/' . $category, 0777, true);
        endif;
        $destinationPath = public_path() . '/app/Blog/' . $category . '/' . $article->title;
        mkdir($destinationPath, 0777, true);
        $file->move($destinationPath, '/' . $file->getClientOriginalName());

        $article->path = '/app/Blog/' . $category . '/' . $article->title . '/' . $file->getClientOriginalName();
        $article->author = Auth::user()->fullname;
        $article->imgName = $file->getClientOriginalName();
        $article->content = $request->content;
        $article->online = $request->online;
        $article->category()->associate($request->category);
        $article->save();

        Session::flash('success', 'L\'article à été créé.');
        return redirect(route('blog.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->first();
        $categories = Category::all();
        return view('admin.blog.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $cat = Category::where('id', $request->category)->first();
//        $category = $cat->name;
//      $file = $request->file('img');

//        if (!file_exists(public_path() . '/app/Blog/' . $category)):
//            mkdir(public_path() . '/app/Blog/' . $category, 0777, true);
//        endif;
//        $destinationPath = public_path() . '/app/Blog/' . $category . '/' . $article->title;
//        mkdir($destinationPath, 0777, true);
//        $file->move($destinationPath, '/' . $file->getClientOriginalName());

        $article = Post::find($id);
        $article->title = $request->title;
//        $article->path = '/app/Blog/' . $category . '/'. $article->title .'/'. $file->getClientOriginalName();
//        $article->author = Auth::user()->fullname;
//        $article->imgName = $file->getClientOriginalName();
        $article->content = $request->content;
        $article->online = $request->online;
        $article->category()->associate($request->category);
        $article->save();

        Session::flash('success', 'L\'article à été mis à jour.');
        return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        Session::flash('success', 'L\'article à été supprimé');
        return redirect(route('blog.index'));

    }

}
