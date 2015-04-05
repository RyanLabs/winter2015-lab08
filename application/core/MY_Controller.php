<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2013, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['title'] = "Top Secret Government Site";    // our default title
        $this->errors = array();
        $this->data['pageTitle'] = 'welcome';   // our default page
    }

    /**
     * Render this page
     */
    function render() {
        //$this->data['menubar'] = $this->parser->parse('_menubar', $this->config->item('menu_choices'),true);
        $this->data['menubar'] = $this->parser->parse('_menubar', $this->makemenu(), true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

        // finally, build the browser page!
        $this->data['data'] = &$this->data;
        $this->data['sessionid'] = session_id();
        $this->parser->parse('_template', $this->data);
    }

    function restrict($roleNeeded = null)
    {
        $userRole = $this->session->userdata( 'userRole' );
        if ( $roleNeeded != null ) {
            if ( is_array( $roleNeeded ) ) {
                if ( !in_array( $userRole, $roleNeeded ) ) {
                    redirect( "/" );
                    return;
                }
            } else if ( $userRole != $roleNeeded ) {
                redirect( "/" );
                return;
            }
        }
    }

    function makemenu() {
        //get role & name from session
        $userRole = $this->session->userdata('userRole');
        // make array, with menu choice for alpha
        $menu = array(array('name' => "Alpha", 'link' => '/alpha'));

        // if not logged in, add menu choice to login
        if( is_null( $userRole ) ) {
            $menu[] = array('name' => 'Login', 'link' => '/auth');
        }
        // if admin, add menu choices for beta, gamma and logout
        else if( !is_null($userRole) && $userRole == 'admin' ) {
            $menu[] = array('name' => "Beta", 'link' => '/beta');
            $menu[] = array('name' => "Gamma", 'link' => '/gamma');
            $menu[] = array('name' => 'Logout', 'link' => '/auth/logout');
        }
        // if user, add menu choice for beta and logout
        else if( !is_null($userRole) && $userRole == 'user' ) {
            $menu[] = array('name' => "Beta", 'link' => '/beta');
            $menu[] = array('name' => 'Logout', 'link' => '/auth/logout');
        }
        // return the choices array
        return array("menudata" => $menu);
    }
}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */