<?php
/**
 * Created by PhpStorm.
 * User: ryansadio
 * Date: 15-04-05
 * Time: 15:44
 */
class Auth extends Application {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    function index() {
        $this->data['pagebody'] = 'login';
        $this->render();
    }
}