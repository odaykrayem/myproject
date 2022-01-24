<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;

class usersController extends Controller
{
    public function index()
    {
        return users::all();

    }

    public function store(Request $request)
    {
        return users::create($request->all());
    }

    public function show($id)
    {
       return users::find($id);
    }

    public function update(Request $request, $id)
    {
        $balance_request = users::find($id);
        $balance_request->update($request->all());

        return $balance_request;
    }

    public function destroy( $id)
    {
        return users::destroy($id);
    }
}
