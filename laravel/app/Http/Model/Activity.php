<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class activity extends Model{
	protected $table='activity';
	protected $primaryKey='id';
	public $timestamps=false;
	protected $guarded=[];


}