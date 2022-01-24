<?php

namespace App\Http\Controllers\API;

use App\Events\ClientCreated;
use App\Http\Controllers\Controller;
use App\Http\Controllers\balanceRequestsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;
use App\Models\balance_requests;
use App\Models\categories;
use App\Models\category_cards;
use App\Models\history;
use App\Models\users;

class AdminController extends Controller
{

    public function getRequests(Request $request)
    {
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
                $history->user_name = (string)categories::where('id', $history->user_id)->pluck('name')->first();
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

    public function getMarketCards()
    {
        try {
            $cards = category_cards::all();
            foreach ($cards as $card) {
                $card->category_name = (string)categories::where('id', $card->category_id)->pluck('name')->first();
            }
            if (count($cards) > 0) {
                return response()->json([
                    'code' => '200',
                    'message' => 'Get Market Cards Successfully',
                    'data' => $cards
                ]);
            } else {
                return response()->json([
                    'code' => '400',
                    'message' => 'No New Market Cards',
                    'data' => $cards
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    //Requests CRUD
    public function storeRequest(Request $request){
        
        try
        {
            $requestObject = new balanceRequestsController();
            $result = $requestObject->store($request);
          if ($result){
            
            return response()->json([
                'code' => '200',
                'message' => 'Request Updated Successfully',
            ]);
          }else {
            return response()->json([
                'code' => '400',
                'message' => 'Error updating request',
            ]);
          }

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '400',
                'message' => $exception->getMessage(),
            ]);
        }
       
    }
    //Requests CRUD
    public function deleteRequest( $id){
        $requestObject = new balanceRequestsController();
        $requestObject->balanceRequestsController::destroy($id);
    }



    //   public function transferOperationsDone(Request $request)
    //   {
    //       try {
    //           $transfer_operation = TransferOperation::findOrFail($request['id']);
    //           $transfer_operation->update(['status'=>1]);
    //           $client = Client::findOrFail($transfer_operation->client_id);
    //           $category = Category::findOrFail($transfer_operation->category_id);
    //           $client->update(['balance'=>$client->balance-$category->price]);
    //           return response()->json([
    //               'code' => '200',
    //               'message' => 'Transfer Operation Completed Successfully',
    //               'data' => $client->balance
    //           ]);
    //       } catch (\Exception $exception) {
    //           return response()->json([
    //               'code' =>'400',
    //               'message' => $exception->getMessage(),
    //           ]);
    //       }
    //   }
}
