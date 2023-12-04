<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    use HasFactory;
    protected $table = 'bank_branches';
    public $timestamps = false;

    public function bank_id(){
        return $this->belongsTo(Bank::class);
    }
}
