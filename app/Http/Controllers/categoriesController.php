<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class categoriesController extends Controller
{
    public function index()
    {
        return categories::all();

    }

    public function store(Request $request)
    {
        return categories::create($request->all());
    }

    public function show($id)
    {
       return categories::find($id);
    }

    public function update(Request $request, $id)
    {
        $balance_request = categories::find($id);
        $balance_request->update($request->all());

        return $balance_request;
    }

    public function destroy( $id)
    {
        return categories::destroy($id);
    }
}
