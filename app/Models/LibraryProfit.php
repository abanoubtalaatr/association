<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryProfit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function soldier()
    {
        return $this->belongsTo(User::class, 'soldier_id');
    }
}
