<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = ['media' => 'array'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getVideoThumbnailUrlAttribute()
    {
        return url('uploads/pics/' . $this->video_thumbnail);
    }

    public function getSharingLinkAttribute()
    {
        $utm = auth()->id() ? auth()->user()->utm : '';
        return route('show_library', [$this->id, $utm]);
    }

    public function getWhatsappResizedThumbAttribute()
    {
        $parts = explode('/', $this->video_thumbnail);
        $parts[3] = 'thumb_' . $parts[3];
        return url('uploads/pics/' . implode('/', $parts));
    }

    public function getMediaPreviewUrlAttribute()
    {
        return url('uploads/pics/' . $this->media[0]);
    }

    public function getWhatsappShareAttribute()
    {
        return $this->title . '%0a' . $this->sharing_link . '%0a' . $this->description;
    }

    public function libraryProfits()
    {
        return $this->hasMany(LibraryProfit::class, 'library_id');
    }
}
