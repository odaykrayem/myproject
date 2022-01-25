<?php

namespace App\Http\Controllers;

use App\Models\balance_requests;
use Illuminate\Http\Request;
use App\Models\users;

class balanceRequestsController extends Controller
{
    public function index(Request $request)
    {
        //  balance_requests::all();
        try {
            if ($request['type'] == '0') {
                $balance_requests = balance_requests::where('type', 0)->orderBy('id', 'ASC')->get();
                $message = 'Get Withdrawal requests Successfully';
            } else {
                $balance_requests = balance_requests::where('type', 1)->orderBy('id', 'ASC')->get();
                $message = 'Get Deposit requests Successfully';

            }
            foreach ($balance_requests as $balance_request) {
                $balance_request->user_name = (string)users::where('id', $balance_request->user_id)->pluck('name')->first();
            }
            if (count($balance_requests) > 0) {
                return response()->json([
                    'code' => '200',
                    'message' => $message,
                    'data' => $balance_requests
                ]);
            } else {
                return response()->json([
                    'code' => '400',
                    'message' => 'No New Requests',
                    'data' => $balance_requests
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),
            ]);
        }
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

    public function destroy(Request $request)
    {
        return balance_requests::destroy($request['id']);
    }
}
