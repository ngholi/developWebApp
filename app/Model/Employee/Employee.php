<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 11/03/2016
 * Time: 10:04 CH
 */

namespace App\Model\Employee;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    public $timestamps = false;

    public function department(){
        return $this->belongsTo('App\Model\Department\Department');
    }
}