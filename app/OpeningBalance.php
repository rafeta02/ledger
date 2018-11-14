<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpeningBalance extends Model
{
    use SoftDeletes;
	protected $table = 'gl_opening_balances';
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];


	public function coa(){
        return $this->belongsTo(Coa::class);
    }
}
