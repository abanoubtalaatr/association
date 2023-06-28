<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactUsResource;
use App\Http\Requests\StoreContactUsRequest;

class ContactController extends Controller{
    public function store(StoreContactUsRequest $request){
        return new ContactUsResource(Contact::create($request->validated()));
    }
}
