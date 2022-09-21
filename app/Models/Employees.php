<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_employee';

    protected $fillable = [
        'employee_name',
        'employee_sector',
        'employee_code',
        'employee_email'

    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'employee_name' => 'string',
        'employee_sector'=> 'string',
        'employee_code'=> 'string',
        'employee_email'=> 'string'

    ];

    
    public function request(){
        return $this->hasMany(Requets::class);
    }
}
