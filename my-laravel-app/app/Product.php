<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes; // SoftDeletesを使用します

	protected $fillable = ['name', 'description', 'point', 'image', 'image2', 'image3'];
}
