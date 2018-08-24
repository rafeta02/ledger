<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Coa extends Model
{
	use SoftDeletes;
    protected $table = 'gl_coas';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $appends = ['typeName'];

    public function ledgers(){
    	return $this->hasMany(Ledger::class);
    }

    public function type(){
        return $this->belongsTo(TypeCoa::class);
    }

    public function journal_details(){
    	return $this->hasMany(JournalDetail::class);
    }

    public function parent()
    {
        return $this->belongsTo(Coa::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Coa::class, 'parent_id');
    }

    public function getTypeNameAttribute()
    {
        return $this->type->name;
    }
}
