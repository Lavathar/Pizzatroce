<?php

namespace pizzatroce\model;


class Role extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function users(){
       return $this->hasMany('\mywishlist\model\User','role');
    }
}