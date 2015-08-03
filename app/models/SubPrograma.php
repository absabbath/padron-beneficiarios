<?php

class SubPrograma extends Eloquent {

   
    protected $fillable = array(
                'nombre_subprograma');

    public $errors;
    protected $table = 'subprogramas';



    /**
     * Funciones para relacionar los diferentes modelos
     */
    
    /**
     * Indica que pertenece a un usuario
     * @return User
     */
    
    public function programa()
    {
        return $this->belongsTo('Programa','id_programas');
    }
    
    /*public function subprogramas()
    {
        return $this->hasMany('Subprograma','id_subprograma');
    }*/
    

    public function isValid($data)
    {
        $rules = array(
            'nombre_subprograma'  => 'required',
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
