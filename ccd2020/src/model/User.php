<?php


namespace pizzatroce\model;


class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function role(){
        return $this->belongsTo('mywishlist\model\Role', 'id');
    }

}