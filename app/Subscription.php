<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    protected $table = 'subscription';
    protected $hidden = ['created_at', 'updated_at'];
}
