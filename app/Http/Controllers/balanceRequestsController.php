<?php

namespace App\Http\Controllers;

use App\Models\balance_requests;
use Illuminate\Http\Request;

class balanceRequestsController extends Controller
{
    public function index()
    {
        return balance_requests::all();

    }

    public function store(Request $request)
    {
        return balance_requests::create($request->all());
    }

    public function show($id)
    {
       return balance_requests::find($id);
    }

    public function update(Request $request)
    {
        $balance_request = balance_requests::find($request['id']);
        $balance_request->update($request->all());

        return $balance_request;
    }

    public function destroy($id)
    {
        return balance_requests::destroy($id);
    }
}
