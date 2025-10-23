<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        set_time_limit(300);
        $limit = min($request->get('limit', 10),100);
        $search = $request->get('search');

        $query = Book::with(['author', 'category'])
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->orderByDesc('ratings_avg_rating');

        if ($search) {
            $query->where('title', 'like', "%$search%")
                  ->orWhereHas('author', fn($q) => $q->where('name', 'like', "%$search%"))
                  ->orWhereHas('category', fn($q) => $q->where('name', 'like', "%$search%"));
        }

        $books = $query->paginate($limit);
        return view('books.index', compact('books', 'limit', 'search'));
    }

    public function topAuthors()
    {
        set_time_limit(300);
        $authors = Author::select('authors.id', 'authors.name', DB::raw('COUNT(ratings.id) as total_votes'))
            ->join('books', 'books.author_id', '=', 'authors.id')
            ->join('ratings', function($join){
                $join->on('ratings.book_id', '=', 'books.id')
                     ->where('ratings.rating', '>', 5);
            })
            ->groupBy('authors.id', 'authors.name')
            ->orderByDesc('total_votes')
            ->limit(10)
            ->get();

        return view('books.top_authors', compact('authors'));
    }

    public function createRating()
    {
        $authors = Author::select('id', 'name')->get();
        return view('books.add_rating', compact('authors'));
    }

    public function getBooksByAuthor($authorId)
    {
        $books = Book::where('author_id', $authorId)
                    ->select('id', 'title')
                    ->get();

        return response()->json($books);
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10'
        ]);

        Rating::create($request->all());
        return redirect()->route('books.index');
    }
}
