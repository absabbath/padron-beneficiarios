<?php

class Dependencia extends Eloquent {

   
    protected $fillable = array(
                'nombre_dependencia', 
                'nombre_director',
                'primer_apellido',
                'segundo_apellido');

    public $errors;
    protected $table = 'dependencias';



    /**
     * Funciones para relacionar los diferentes modelos
     */
    
    /**
     * Indica que pertenece a un usuario
     * @return User
     */
    
    public function usuarios()
    {
        return $this->hasMany('User','id_dependencia');
    }

    public function programas()
    {
        return $this->hasMany('Programa', 'id_dependencia');
    }
    

    public function isValid($data)
    {
        $rules = array(
            'nombre_dependencia'  => 'required|min:3|max:30|regex:[^[a-zA-Zzáéíóúñ[:space:]]*$]',
            'nombre_director' =>'required|min:3|max:30|regex:[^[a-zA-Zzáéíóúñ[:space:]]*$]',
            'primer_apellido'    => 'required|min:3|max:30|regex:[^[A-Za-záéíóúñ]*$]',
            'segundo_apellido' =>'min:3|max:30|regex:[^[A-Za-záéíóúñ]*$]',
        );


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
