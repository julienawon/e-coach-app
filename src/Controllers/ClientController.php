<?php
    namespace App\Controllers;

    
    class ClientController extends Controller{

        public function index($params = []){
            $this->render('Client/profile');
        }

        /**
         * 
         * Display the specified resource
         * @param array $params
         * @return void
         * 
         */
        public function show(){
            $this->render('Client/profile');
        }
    }