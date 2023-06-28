<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;

class TransactionController extends Controller{
    public function __invoke(){
        return TransactionResource::collection(auth('api-users')->user()->transactions()->paginate());
    }
}
