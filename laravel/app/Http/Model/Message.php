<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/28
 * Time: 14:48
 */

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class message extends Model{
    protected $table='message';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $guarded=[];


}