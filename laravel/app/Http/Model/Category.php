<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class category extends Model{
	protected $table='category';
	protected $primaryKey='id';
	public $timestamps=false;
	protected $guarded=[];


	public function tree(){
		$info=$this->orderBy('id','asc')->get();//dd($info);
		return $this->getTree($info,'cat_name','id','cat_pid');
		
	}


	public function getTree($data,$field_name,$id,$cat_pid,$pid=0){
		
			$arr = array();
			foreach ($data as $k=>$v){
				if($v->$cat_pid==$pid){
					$data[$k]['_'.$field_name]=$data[$k][$field_name];
					$arr[]=$data[$k];
					foreach($data as $m=>$n){
						if($n->$cat_pid==$v->$id){
							$data[$m]['_'.$field_name]='|——'.$data[$m][$field_name];
							$arr[]=$data[$m];
						}
					}
				}
			}
			return ($arr);
	}



}