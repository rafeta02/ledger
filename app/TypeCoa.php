<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeCoa extends Model
{
    use SoftDeletes;
	protected $table = 'gl_type_coas';
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

    public function coas(){
    	return $this->hasMany('App\Coa', 'coa_id');
    }
}
