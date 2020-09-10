<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentDetail extends Model
{
    protected $fillable = [
        'content_id', 'name', 'body', 'status', 'order','deleted'
    ];
}
