<?php

    namespace Models;

    use Models\DB;
    
    class user extends DB   {
        public $table;
        function __construct(){
            paren::__construct();
            $this->table = $this->db_connect();
        }

        protected $campos = ['name','username','passwd'];

        public $valores = [];
        
    }