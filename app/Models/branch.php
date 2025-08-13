<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    protected $guarded = ['id'];
    protected $table = 'branches';

public function client(){
    return $this->belongsTo(client::class,'client_id');
}



}
