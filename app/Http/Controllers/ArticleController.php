<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = auth()->user();
        $articles = Article::orderBy('created_at', 'desc')->paginate(8);
        return view('articles.index', compact('articles', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('articles.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|string|min:10|max:50',
            'description' => 'required|string|min:30|max:4000',
        ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png|max:5000']);
            $formFields['image'] = $request->file('image')->store('images/articles', 'public');
        }

        $formFields['user_id'] = auth()->id();
        Article::create($formFields);

        return redirect()->route('article.index')->with('message', 'You have successfully upload new article!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $user = auth()->user();
        $owner = $article->user->only(['name', 'image']);
        if ($user->id === $article->user->id) {
            $owner['ownItem'] = true;
        }
        return view('articles.show', compact('article', 'user', 'owner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Sorry, you do not have access to this article.');
        }

        $user = auth()->user();
        return view('articles.edit', compact('article', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Sorry, you do not have access to this article.');
        }

        $formFields = $request->validate([
            'title' => 'required|string|min:10|max:50',
            'description' => 'required|string|min:30|max:4000',
        ]);

        if ($request->hasFile('image')) {

            $request->validate(['image' => 'mimes:jpg,jpeg,png|max:5000']);

            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $formFields['image'] = $request->file('image')->store('images/articles', 'public');
        }

        $article->update($formFields);
        return redirect()->route('article.index')->with('message', 'Article updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Sorry, you do not have access to this article.');
        }

        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return redirect()->route('article.index')->with('message', 'Article deleted successfully 👍');
    }
}
