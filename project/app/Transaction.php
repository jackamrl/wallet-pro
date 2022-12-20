<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['transid', 'mainacc', 'accto', 'accfrom', 'type', 'sign', 'referance', 'amount','fee', 'reason', 'withdrawid', 'trans_date', 'status'];
    public $timestamps = false;
    public static $withoutAppends = false;

    public function getAcctoAttribute($accto)
    {
        if(self::$withoutAppends){
            return $accto;
        }
        return UserAccount::findOrFail($accto);
    }

    public function getAccfromAttribute($accfrom)
    {
        if(self::$withoutAppends){
            return $accfrom;
        }
        return UserAccount::findOrFail($accfrom);
    }

    public function getMainaccAttribute($mainacc)
    {
        if(self::$withoutAppends){
            return $mainacc;
        }
        return UserAccount::findOrFail($mainacc);
    }

    public function getwithdrawidAttribute($withdrawid)
    {
        if(self::$withoutAppends){
            return $withdrawid;
        }
        return Withdraw::findOrFail($withdrawid);
    }


}
