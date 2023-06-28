<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;

class WalletController extends Controller{
    public function index(Request $request){
        return WalletResource::collection(
            auth('api-users')
            ->user()
            ->paybackRequests()
            ->when(request('status'),function($query,$status){
               return $query->whereStatus($status);
            })
            ->paginate()
        );
    }
}
