<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LibraryResource extends JsonResource{

    public function toArray($request){
        $media = $this->media;
        foreach($media as $k=>$v){
            $media[$k] = url('uploads/pics/'.$v);
        }

        return [
            'id'=>$this->id,
            // 'sharing_link'=>url('/'),
            'sharing_link'=>$this->sharing_link,
            'title'=>$this->title,
            'description'=>$this->description,
            'short_description'=>$this->short_description,
            'link'=>$this->link,
            'video_thumbnail'=>$this->video_thumbnail_url,
            'media'=>$media,
            'media_type'=>$this->media_type,
            'created_at'=>$this->created_at

        ];
    }
}
