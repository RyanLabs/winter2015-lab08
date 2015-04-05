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
    function submit()
    {
        $key = $_POST['userid'];
        $pwd = $_POST['password'];
        $user = $this->users->get($key);
        $verified = password_verify($pwd, $user->password);
        if ( $verified ) {
            $this->session->set_userdata( 'userID', $key );
            $this->session->set_userdata( 'userName', $user->name );
            $this->session->set_userdata( 'userRole', $user->role );
        }
        /*echo('var_dump($pwd); ');
        var_dump($pwd);
        echo('<br/>$user->password ');
        var_dump($this->users->get($key));
        echo('<br/>var_dump($verified); ');
        var_dump($verified);
        echo('<br/>var_dump($key); ');
        var_dump($key);
        echo('<br/>var_dump($user); ');
        var_dump($user);*/
        redirect( '/' );
    }
    function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }
}