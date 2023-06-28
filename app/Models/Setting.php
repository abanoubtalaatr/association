<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    public function getAdvertiserWhatsAppFileAttribute($value)
    {
        return url('uploads/pics/' . $value);
    }
}
