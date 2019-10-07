<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::select('title', 'subtitle', 'content')
            ->get();

        $data = [
            'news' => $news
        ];

        return View('admin.news.index')->with($data);
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
        //
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

    public function getNewsArticles(Request $request)
    {
        if ( $request->input('showdata') ) {
            return News::orderBy('created_at', 'desc')->get();
            
        }

        $columns = ['title', 'subtitle', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column'); 
        $search_input = $request->input('search');
        $query = UsNewser::select('title', 'subtitle', 'created_at'); //->orderBy($columns[$column]);

        if ($search_input) {
            $query->where(function($query) use ($search_input) {
                $query->where('title', 'like', '%' . $search_input . '%')
                ->orWhere('subtitle', 'like', '%' . $search_input . '%')
                ->orWhere('created_at', 'like', '%' . $search_input . '%');
            });
        }

        $news = $query->paginate($length);

        return ['data' => $news];
    }
}
