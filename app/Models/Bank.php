<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'banks';
    public $timestamps = false;

    public function bank_branches(){
        return $this->hasMany(BankBranches::class);
    }
}
