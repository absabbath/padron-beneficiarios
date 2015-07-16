<?php

class UsuarioController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

    }

    public function index()
    {
        return "index";
    }

    public function create()
    {
        return "create";   
    }

    public function store()
    {
        
    }

    public function show($id)
    {
        return "show".$id;
    }

    public function edit($id)
    {
        return "edit".$id;
    }

    public function update($id)
    {
        
    }

    public function destroy($id)
    {
        
    }



}
