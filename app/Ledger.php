<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ledger extends Model
{
    use SoftDeletes;
    protected $table = 'gl_ledgers';
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

	public function coa(){
    	return $this->belongsTo('App\Coa', 'coa_id');
    }
}
