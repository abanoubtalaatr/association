<?php

namespace App\Http\Controllers\Api;

use App\Models\Camp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampResource;
use App\Http\Requests\CreateCampRequest;
use App\Http\Requests\UpdateCampRequest;

class CampController extends Controller{
    public function index(Request $request){
        $records =
            auth('api-users')
            ->user()
            ->camps()
            ->latest()
            ->when(request('type'),function($query,$type){
                return $query->whereType($type);
            })->when(request('active'),function($query){
                return $query->whereStatus('active');
            });
        return CampResource::collection(
            request('paginate')? $records->paginate() : $records->get()
        );
    }


    public function store(CreateCampRequest $request){
        return response()->json(['data'=>auth('api-users')->user()->camps()->create($request->validated())]);
    }

    public function update(UpdateCampRequest $request,Camp $camp){
        abort_if($camp->user_id != auth('api-users')->id(),401,__('site.not_allowed'));
        $camp->update($request->validated());
        return response()->json(['data'=>new CampResource($camp->fresh())]);
    }

    public function deactivate(Request $request, Camp $camp){
        abort_if($camp->user_id != auth('api-users')->id(),401,__('site.not_allowed'));
        $camp->update(['status'=>'inactive']);
        return response()->json(['data'=>new CampResource($camp->fresh())]);
    }

    public function campTypes(){
        $types=  [
            [
                'key'=>'awarness',
                'title'=>__('site.awarness'),
                'image'=>url(asset('camp_types/awarness.png'))
            ],
            [
                'key'=>'traffic',
                'title'=>__('site.traffic'),
                'image'=>url(asset('camp_types/traffic.png'))
            ],
            [
                'key'=>'app_installs',
                'title'=>__('site.app_installs'),
                'image'=>url(asset('camp_types/app_installs.png'))
            ],
            [
                'key'=>'video_views',
                'title'=>__('site.video_views'),
                'image'=>url(asset('camp_types/video_views.png'))
            ],
            [
                'key'=>'messages',
                'title'=>__('site.messages'),
                'image'=>url(asset('camp_types/messages.png'))
            ],
            [
                'key'=>'lead_generation',
                'title'=>__('site.lead_generation'),
                'image'=>url(asset('camp_types/lead_generation.png'))
            ]
        ];
        return response()->json($types);
    }
}
