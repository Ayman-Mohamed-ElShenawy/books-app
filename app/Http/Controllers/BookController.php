<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;




class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Book $book, User $user): JsonResponse
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $books = $book->paginate(8);
        } else {
            $books = $book->where('user_id', $user->id)->paginate(8);
        }

        if ($books->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => [
                    'data' => $books->items(),
                    'pagination' => [
                        'current_page' => $books->currentPage(),
                        'last_page' => $books->lastPage(),
                        'per_page' => $books->perPage(),
                        'total' => $books->total(),
                        'prev_page_url' => $books->previousPageUrl(),
                        'next_page_url' => $books->nextPageUrl(),
                    ],
                ],
            ], 200);
        }

        return response()->json([
            'status' => 404,
            'message' => 'No Books Found',
        ], 404);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'author' => 'required|string|max:50',
            'upload' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('upload') && $request->file('upload')->isValid()) {
            $fileName = time() . '.' . $request->file('upload')->extension();
            $path = $request->file('upload')->storeAs($fileName);


            $book->create([
                'user_id' => Auth::id(),
                'title' => $validatedData['title'],
                'author' => $validatedData['author'],
                'upload' => $path,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Book added successfully',
                'book' => $book,
            ], 200);
        }
        return response()->json([
            'status' => 422,
            'message' => 'Failed to upload book',
        ], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        return view('searchbooks', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): JsonResponse
    {
        if ($book) {
            return response()->json([
                'status' => 200,
                'message' => $book,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Book With That id Found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'author' => 'required|string|max:50',
            'upload' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('upload') && $request->file('upload')->isValid()) {
            $fileName = time() . '.' . $request->file('upload')->extension();
            $path = $request->file('upload')->storeAs($fileName);

            $book->update([
                'title' => $validatedData['title'],
                'author' => $validatedData['author'],
                'upload' => $path,
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Book added successfully',
                'book' => $book,
            ], 200);
        } else {
            $book->update([
                'title' => $validatedData['title'],
                'author' => $validatedData['author'],
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Book added successfully',
                'book' => $book,
            ], 200);
        }
        if (!$validatedData['title'] && !$validatedData['authr'] || !$validatedData['title'] && !$validatedData['authr'] && !$validatedData['upload']) {
            return response()->json([
                'status' => 422,
                'message' => 'Failed to Update Book',
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): JsonResponse
    {
        if ($book) {
            $book->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Book Deleted Successfully',
                'book' => $book,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Book Not Found',
            ], 404);
        }
    }

    /**
     *  display search results for a book
     */

    public function searchResults(Request $request, Book $book): JsonResponse
    {
        $query = $request->input('query');

        if ($query) {
            $results = $book->Where('title', 'LIKE', "%$query%")->orWhere('author', 'LIKE', "%$query%")->orWhere('upload', 'LIKE', "%$query%")
                ->limit(10)->get();
        } else {
            $results = collect();
        }
        return response()->json($results);
    }

    /**
     * display other users data to to current user
     */
    public function otherUsersData(Book $book): View
    {  
        $books = Book::all();
        return view('home', compact('books'));
    }
    /**
     * show all users
     */
    public function showUsers(): View
    {
         
        $users = User::all();
        return view('showusers', compact('users'));
    }

}
