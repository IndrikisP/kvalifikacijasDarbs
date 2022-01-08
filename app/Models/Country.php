<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'tests';

    public $primaryKey = 'id';

    public $timestamps = true;
}
