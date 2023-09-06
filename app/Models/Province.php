<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $primaryKey = 'province_id';

    public $keyType = 'string';

    protected $fillable = [
        'province_id',
        'province',
    ];
}
