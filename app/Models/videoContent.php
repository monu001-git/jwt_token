<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videoContent extends Model
{
    use HasFactory;
    protected $table = 'videoContents';

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
