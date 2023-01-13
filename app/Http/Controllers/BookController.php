<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date =date('Y/m/d');

        if($request->ajax()){
            if(empty($request->category)){
                $books = DB::select('SELECT * FROM books WHERE ID != ALL (SELECT books_ID FROM bookings WHERE date_delivery > CURDATE())');
            }else{
                $books = DB::select('SELECT * FROM books WHERE ID != ALL (SELECT books_ID FROM bookings WHERE date_delivery > CURDATE()) and categories_id= ?', [$request->category]);
            }

            return response()->json(['books' => $books]);
        }

        $books = DB::select('SELECT * FROM books WHERE ID != ALL (SELECT books_ID FROM bookings WHERE date_delivery > CURDATE())');

        $categories = DB::table('categories')->get();


        return view('library')->with('books',$books)
                              ->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = DB::table('books')->find($id);
        // return response()->json($book);
        return $book;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
