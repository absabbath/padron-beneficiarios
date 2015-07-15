<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Rol extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    public static $rules = array(
        'name'    => 'required',
        // 'description' => 'required',
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    public function users()
    {
        return $this->hasMany('User','id_rol','id');
    }

}
