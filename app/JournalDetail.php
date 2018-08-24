<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalDetail extends Model
{
    public $timestamps = false;
    protected $table = 'gl_journal_details';
	protected $guarded = ['id'];
    protected $appends = ['journalDate', 'journalDescription', 'saldo', 'coaName'];

	public function coa(){
    	return $this->belongsTo(Coa::class, 'coa_id');
    }

    public function journal(){
    	return $this->belongsTo(Journal::class, 'journal_id');
    }

    public function getCoaNameAttribute(){
        return $this->coa->code." - ".$this->coa->name;
    }

    public function getJournalDateAttribute(){
        return $this->journal->date;
    }

    public function getJournalDescriptionAttribute(){
        return $this->journal->description;
    }

    public function getSaldoAttribute(){
        if($this->debet == null){
            $saldo = 0 - $this->kredit;
        }
        if($this->kredit == null){
            $saldo = $this->debet;
        }
        return $saldo;
    }
}
