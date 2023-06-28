<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller{
    public function index(Request $request){
        $relation = auth('api-users')->user()->notifications();
        if(in_array($request->status,['read','unread'])){
                $relation = $relation->{request('status')}();
        }
        return  NotificationResource::collection($relation->latest()->paginate());
    }

     public function update($notification){
		$notification = auth('api-users')->user()->notifications()->where('id', $notification)->update(['read_at'=>now()]);
        return response()->json([]);
    }
}
