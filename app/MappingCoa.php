<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MappingCoa extends Model
{
    use SoftDeletes;
    protected $table = 'gl_mapping_coas';
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

    public function mapping_parent()
    {
        return $this->hasOne('App\Coa', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Coa', 'child_id');
    }
}
