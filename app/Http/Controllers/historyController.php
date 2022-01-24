<?php

namespace App\Http\Controllers;

use App\Models\history;
use Illuminate\Http\Request;

class historyController extends Controller
{
    public function index()
    {
        return history::all();

    }

    public function store(Request $request)
    {
        return history::create($request->all());
    }

    public function show($id)
    {
       return history::find($id);
    }

    public function update(Request $request, $id)
    {
        $balance_request = history::find($id);
        $balance_request->update($request->all());

        return $balance_request;
    }

    public function destroy( $id)
    {
        return history::destroy($id);
    }
}