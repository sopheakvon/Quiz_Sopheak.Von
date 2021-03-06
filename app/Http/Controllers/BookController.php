<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'min:3|max:10',
            'body'=>'min:3|max:50'
        ]);
        $book = new Book();
        $book->title = $request->title;
        $book->body = $request->body;
        $book->author_id = $request->author_id;
        $book->save();
        
        return response()->json(['message' => 'Book Created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3|max:10',
            'body'=>'min:3|max:50'
        ]);
        $book = Book::FindOrFail($id);;
        $book->title = $request->title;
        $book->body = $request->body;
        $book->author_id = $request->author_id;
        $book->save();
        
        return response()->json(['message' => 'Book Updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDelete = Book::destroy($id);
        if($isDelete == 1)
            return response()->json(['message'=> 'Bookr delete successfully'],200);
            return response()->json(['message'=> 'ID Not Esist'],404);
    }
}
