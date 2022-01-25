<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\users;
use Illuminate\Http\Request;

class historyController extends Controller
{
    //needs type
    public function getHistory(Request $request)
    {
        try {
            if ($request['type'] == '0') {
                $histories = history::where('type', 0)->orderBy('id', 'ASC')->get();
                $message = 'Get Purchases records Successfully';
            } else {
                $histories = history::where('type', 1)->orderBy('id', 'ASC')->get();
                $message = 'Get Sales records Successfully';
            }
            foreach ($histories as $history) {
                $history->user_name = (string)users::where('id', $history->user_id)->pluck('name')->first();
            }
            if (count($histories) > 0) {
                return response()->json([
                    'code' => '200',
                    'message' => $message,
                    'data' => $histories
                ]);
            } else {
                return response()->json([
                    'code' => '400',
                    'message' => 'No New Records',
                    'data' => $histories
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    //needs user_id, type
    public function getUserHistory(Request $request)
    {
        try {
            if ($request['type'] == '0') {
                $histories = history::where([

                    ['type', '=', '0'],
            
                    ['user_id', '=', $request['user_id']]
            
                ])->orderBy('id', 'ASC')->get();
                $message = 'Get Purchases records Successfully';
            } else {
                $histories = history::where([

                    ['type', '=', '1'],
            
                    ['user_id', '=', $request['user_id']]
            
                ])->orderBy('id', 'ASC')->get();
                $message = 'Get Sales records Successfully';
            }
            if (count($histories) > 0) {
                return response()->json([
                    'code' => '200',
                    'message' => $message,
                    'data' => $histories
                ]);
            } else {
                return response()->json([
                    'code' => '400',
                    'message' => 'No New Records',
                    'data' => $histories
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    

    //all history data is required
    public function store(Request $request)
    {
        return history::create($request->all());
    }

    //need history id
    public function show($id)
    {
       return history::find($id);
    }

    //need id, other parameters are optional
    public function update(Request $request)
    {
        $product_request = history::find($request['id']);
        $product_request->update($request->all());

        return $product_request;
    }

    //needs id
    public function destroy( $id)
    {
        return history::destroy($id);
    }
}