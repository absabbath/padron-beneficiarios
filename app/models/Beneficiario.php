<?php

class Beneficiario extends Eloquent {

    protected $fillable = array(
                'nombre_beneficiario',
                'primer_apellido_beneficiario',
                'segundo_apellido_beneficiario',
                'edad',
                'ocupacion',
                'clave_electoral',
                'secc_electoral',
                'num_int',
                'num_ext',
                'colonia',
                'calle',
                'cp',
                'tel_casa',
                'tel_cel',
                'email',
                'comentario');

    public $errors;
    protected $table = 'beneficiarios';



    /**
     * Funciones para relacionar los diferentes modelos
     */
    
    /**
     * Tiene muchos apoyos
     * @return User
     */
    
   /* public function apoyos()
    {
        return $this->hasMany('User','id_usuario');
    }*/
    

    public function isValid($data)
    {
        $rules = array(
            'nombre_beneficiario'  => 'required',
            'primer_apellido_beneficiario'    => 'required',
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
