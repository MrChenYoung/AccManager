<?php


namespace admin\controller;


use framework\core\Controller;

class RSAKeyManagerController extends Controller
{
    public function index()
    {
        parent::index(); // TODO: Change the autogenerated stub
        $this -> loadTemplate(["data"=>$this -> data],"RSAKey/index.html");
    }
}