<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Setup extends Model
{
    protected $table = 'gl_setups';
    protected $guarded = ['id'];

    public function setup_details(){
    	return $this->hasMany(SetupDetail::class, 'setup_id');
    }
}
