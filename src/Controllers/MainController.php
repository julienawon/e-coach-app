<?php
    namespace App\Controllers;

    class MainController extends Controller {

        /**
         * 
         * Display a listing of the resource
         * @param array $params
         * @return void
         * 
         */ 
        public function index($params = []) {
            $this->render('Home/index');
        }

        /**
         * 
         * Create a new resource
         * @param array $params
         * @param array $post
         * @return void
         * 
         */
        public function create($params = [], $post = []) {
            $this->render('Guest/register');
        }

        /**
         * 
         * Store a newly created resource in storage
         * @param array $params
         * @param array $post
         * @return void
         * 
         */
        public function login($params = [], $post = []) {
            $this->render('Guest/login');
        }

        public function aboutUs($params = []) {
            $this->render('Home/about-us');
        }

        public function cgu($params = []) {
            $this->render('Home/cgu');
        }

        public function faqs($params = []) {
            $this->render('Home/faqs');
        }
    }