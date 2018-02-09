<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class topic extends Model{
	protected $table='topic';
	protected $primaryKey='id';
	public $timestamps=false;
	protected $guarded=[];

}