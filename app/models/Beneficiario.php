<?php

class Beneficiario extends Eloquent {

    protected $fillable = array(
                'nombre_beneficiario',
                'primer_apellido_beneficiario',
                'segundo_apellido_beneficiario',
                'edad',
                'ocupacion',
                'sexo',
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
    
    public function apoyos()
    {
        return $this->hasMany('Apoyo','id_beneficiarios');
    }
    

    public function isValid($data)
    {
        $rules = array(
            'nombre_beneficiario'  => 'required|max:30|regex:[^[a-zA-Zzáéíóúñ[:space:]]*$]',
            'primer_apellido_beneficiario'    => 'required|max:30|regex:[^[a-zA-Zzáéíóúñ[:space:]]*$]',
            'segundo_apellido_beneficiario' => 'max:30|regex:[^[a-zA-Zzáéíóúñ[:space:]]*$]',
            'calle' => 'required',
            'colonia' => 'required',
            'secc_electoral' => 'regex:/^[0-9]*$/',
            'edad' => 'regex:/^[0-9]*$/',
            'cp' => 'regex:/^[0-9]*$/',


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
