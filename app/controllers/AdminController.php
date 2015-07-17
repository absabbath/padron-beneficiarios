<?php

class AdminController extends BaseController {

    public function __construct() {

        $this->beforeFilter('auth', array());

        $this->beforeFilter('csrf', array( 'on' => 'post' ));

    }

    public function panelAdmin()
    {

        return View::make('admin/index');

    }

}
