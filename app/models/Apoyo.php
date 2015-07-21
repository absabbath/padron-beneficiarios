<?php

class Apoyo extends Eloquent {

    protected $fillable = array(
                'monto',
                'fecha',
                'periodicidad'
               );

    public $errors;
    protected $table = 'apoyos';



    /**
     * Funciones para relacionar los diferentes modelos
     */
    
    /**
     * Tiene muchos apoyos
     * @return User
     */
    
    public function beneficiario()
    {
        return $this->belongsTo('Beneficiario','id_beneficiarios');
    }
    

    public function isValid($data)
    {
        $rules = array(
            'fecha'  => 'required',
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
