<?php

class Apoyo extends Eloquent {

    protected $fillable = array(
                'monto',
                'fecha',
                'periodicidad',
                'concepto',
                'id_tipo_apoyos',
                'id_beneficiarios',
                'id_subprogramas'
               );

    public $errors;
    protected $table = 'apoyos';
    protected $perPage = 25;


    /**
     * Tiene muchos apoyos
     * @return User
     */
    
    public function beneficiario()
    {
        return $this->belongsTo('Beneficiario','id_beneficiarios');
    }
    

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


    public function buscarTipo($id)
    {
        $tipo = DB::table('tipo_apoyos')->where('id', $id)->pluck('nombre_tipo_apoyo');
        return $tipo;

        //$name = DB::table('users')->where('name', 'John')->pluck('name');  
    }


    /**
     * getProgramas   Retornar los programas por cada dependecia
     * @param  int $id_dependencia id de la dependencia que serequiere
     * @return array                 id y nombre de programa
     */
    public function getProgramas($id_dependencia)
    {
        if ($id_dependencia == 0) {
            $programas = Programa::all();

        } else {

            $dependencia = Dependencia::find($id_dependencia);
            $programas = $dependencia->programas()->get();
            
        }

        $combo = [];
        $combo [0] = "Selecciona un programa";

        foreach ($programas as $programa) {
            $combo[$programa->id] = $programa->nombre_programa;
        }

        return $combo;
    }

    public function getDependencia($id_subprograma)
    {
        $programa = SubPrograma::find($id_subprograma)->programa()->get()->first();
        $dependencia = Dependencia::find($programa->id_dependencia);
        return $dependencia->nombre_dependencia;

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
            'id_subprogramas' => 'required',
            'monto'  => 'required|numeric|max:999999',
            'concepto' => 'required',
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
