<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(25);
        return view('articles.list', [
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'title' => 'required|min:5',
            'author' => 'required|min:5',
        ]);

        if ($validator->passes()) {

            $article = new Article();
            $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();

            return redirect()->route('article.index')->with('success', 'Article added successfully');

        } else {
            return redirect()->route('article.create')->withInput()->withErrors($validator);
        }

    }

    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);
        $validator = Validator::make($request->all(), [

            'title' => 'required|min:5',
            'author' => 'required|min:5',
        ]);

        if ($validator->passes()) {

            $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();

            return redirect()->route('article.index')->with('success', 'Article updated successfully');

        } else {
            return redirect()->route('article.edit', $id)->withInput()->withErrors($validator);
        }
    }

    public function destroy (Request $request) {
        $article = Article::find($request->id);

        if ($article == null) {
            session()->flash('error', 'Article not found');
           return response()->json([
                'status' => false,
           ]);
        }

        $article->delete();
        session()->flash('error', 'Article deleted successfully');
           return response()->json([
                'status' => true,
           ]);
    }

}
