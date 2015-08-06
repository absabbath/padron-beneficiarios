<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

     protected $fillable = array(
                'login',
                'email', 
                'nombre',
                'primer_apellido',
                'segundo_apellido',
                'id_rol',
                'id_dependencia',
                'estatus');

    public $errors;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function rol()
    {
        return $this->belongsTo('Rol','id_rol');
    }

    public function dependencia()
    {
        return $this->belongsTo('Dependencia','id_dependencia');
    }

    public function hasRole($rolName)
    {
        $rol = $this->rol->toArray();
        if ( $rol['name'] == $rolName) {
            return true;
        }
        return false;
    }


     public function isValid($data)
    {
        $rules = [
            'login'            => 'required|min:5|max:20|unique:users',
            'email'            => 'email|unique:users',
            'nombre'            => 'required',
            'primer_apellido'  => 'required|max:64',
            'segundo_apellido'  => 'required|max:64',
        ];

        if ($this->exists) {
            /*
            Si el usuario existe permite sobreescribir con el mismo email o mismo username
             */
            $rules['email'] .= ',email,' . $this->id;
            $rules['login'] .= ',login,' . $this->id;
        }
        
        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }


    public function validAndSave($data)
    {

        if ($this->isValid($data)) {
            $this->fill($data);
            $this->save();

            return true;
        }

        return false;
    }



}
