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

    /**
     * Funciones accesibles en todo el sistema
     */
    

    /**
     * getTipo obtiene los tipos de apoyo y los envia en un arreglo para el formulario
     * @return array ID y Tipo
     */ 
    public function getTipo()
    {
        
        $tipos = DB::table('tipo_apoyos')->select('id', 'nombre_tipo_apoyo')->get();
        $combo = [];
        foreach ($tipos as $tipo) {
            $combo[$tipo->id] = $tipo->nombre_tipo_apoyo;
        }

        return $combo;
    }


    /**
     * getProgramas   Retornar los programas por cada dependecia
     * @param  int $id_dependencia id de la dependencia que serequiere
     * @return array                 id y nombre de programa
     */
    public function getProgramas($id_dependencia)
    {
        $dependencia = Dependencia::find($id_dependencia);
        $programas = $dependencia->programas()->get();
        $combo = [];

        foreach ($programas as $programa) {
            $combo[$programa->id] = $programa->nombre_programa;
        }

        return $combo;
    }
    


    /**
     * isValid Aqui las reglas de validacion
     * @param  array  $data los datos capturdos del formulario
     * @return boolean       [description]
     */
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
