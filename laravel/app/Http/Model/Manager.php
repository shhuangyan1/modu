<?php
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;


class Manager extends Model{
	protected $table='admin';
	protected $primaryKey='id';
	public $timestamps=false;
	protected $guarded=[];


}



