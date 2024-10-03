<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageContent extends Model
{
    use HasFactory;
    protected $table = 'imageContents';

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
