<?php

class Programa extends Eloquent {

   
    protected $fillable = array(
                'nombre_programa');

    public $errors;
    protected $table = 'programas';



    /**
     * Funciones para relacionar los diferentes modelos
     */
    
    /**
     * Indica que pertenece a un usuario
     * @return User
     */
    
    public function dependencia()
    {
        return belongsTo('Dependencia','id_dependencia');
    }
    
    public function subprogramas()
    {
        return $this->hasMany('SubPrograma','id_programas');
    }
    

    public function isValid($data)
    {
        $rules = array(
            'nombre_programa'  => 'required',
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
