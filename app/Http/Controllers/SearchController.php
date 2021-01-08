<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class SearchController extends Controller
{
    /**
     * Search for results
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function search(Request $request)
    {
        $key = trim($request->q);

        $users = User::query()->where('name', 'like', '%' . $key . '%')->orWhere('username', 'like', '%' . $key .'%')->get();

        $data = [
            'title' => 'Search',
            'page'  => 'search',
            'users' => $users
        ];

        return view('search.index')->with($data);
    }
}
