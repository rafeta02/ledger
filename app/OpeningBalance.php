<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningBalance extends Model
{
    use SoftDeletes;
	protected $table = 'gl_opening_balances';
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];
}
