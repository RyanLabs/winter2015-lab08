<?php
/**
 * Created by PhpStorm.
 * User: ryansadio
 * Date: 15-04-05
 * Time: 15:41
 */
class Users extends MY_Model {
    public function __construct() {
        parent::__construct('users', 'name');
    }
}