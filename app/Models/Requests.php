<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Employees;
use App\Models\Types;

class Requests extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'requests';

    protected $primaryKey = 'id_request';

    protected $fillable = [
        'request_type',
        'request_status',
        'request_value',
        'request_date',
        'id_employee',
        'id_sector',
        'id_type',
        'is_dinner',


    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

        'request_type' => 'string',
        'request_status'=> 'integer',
        'request_value'=> 'float',
        'request_date'=> 'datetime',
        'id_employee' => 'integer',
        'id_type' => 'integer',
        'is_dinner' => 'integer',

    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }
    
    public function type()
    {
        return $this->hasOne(Types::class);
    }


}
