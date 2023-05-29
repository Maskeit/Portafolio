<?php

namespace Models;

use Models\DB;

class carousel extends DB {
    public $table;
    function __construct(){
        parent::__construct();
        $this->table = $this->db_connect();
    }

    protected $campos = ['id','images','title','parrafo'];

    public $valores = [];

}