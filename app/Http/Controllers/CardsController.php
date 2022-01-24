<?php

namespace App\Http\Controllers;

use App\Models\category_cards;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function index()
    {
        return category_cards::all();

    }

    public function store(Request $request)
    {
        return category_cards::create($request->all());
    }

    public function show($id)
    {
       return category_cards::find($id);
    }

    public function update(Request $request, $id)
    {
        $balance_request = category_cards::find($id);
        $balance_request->update($request->all());

        return $balance_request;
    }

    public function destroy( $id)
    {
        return category_cards::destroy($id);
    }
}
