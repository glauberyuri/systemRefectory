<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_config';

    protected $fillable = [
        'config_value',
        'config_ini_lunch',
        'config_end_lunch',
        'config_ini_dinner',
        'config_end_dinner'
    ];
         /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    
    protected $casts = [
        'config_value' => 'float',
        'config_ini_lunch'=> 'datetime',
        'config_end_lunch'=> 'datetime',
        'config_ini_dinner'=> 'datetime',
        'config_end_dinner' => 'datetime'
    ];
}
