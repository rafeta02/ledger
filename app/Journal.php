<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
	use SoftDeletes;
	protected $table = 'gl_journals';
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];

    public function journal_details(){
    	return $this->hasMany(JournalDetail::class, 'journal_id');
    }

    public function scopeNotPosted(Builder $builder)
    {
        return $builder->where('is_posted', 0);
    }

    public function scopeIsPosted(Builder $builder)
    {
        return $builder->where('is_posted', 1);
    }
}
