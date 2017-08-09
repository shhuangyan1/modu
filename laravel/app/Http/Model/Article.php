<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class article extends Model{
	protected $table='article';
	protected $primaryKey='id';
	public $timestamps=false;
	protected $guarded=[];


}