<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 11/03/2016
 * Time: 10:12 CH
 */

namespace App\Model\Department;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    public $timestamps = false;

    public function employees(){
        return $this->hasMany('App\Model\Employee\Employee');
    }

    public function managedBy(){
        return $this->belongsTo('App\Model\Employee\Employee', 'manager');
    }
}