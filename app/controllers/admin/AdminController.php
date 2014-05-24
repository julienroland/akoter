<?php

class Admin_AdminController extends \BaseController
{
    public function index()
    {
        return View::make('admin.index');
    }
}