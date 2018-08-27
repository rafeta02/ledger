<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetupDetail extends Model
{
    protected $table = 'gl_setup_details';
    protected $guarded = ['id'];

    public function type_coa(){
    	return $this->belongsTo(TypeCoa::class, 'typecoa_id');
    }

    public function setup(){
        return $this->belongsTo(Setup::class, 'setup_id');
    }

}
