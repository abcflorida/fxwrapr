<?php

/**
 * Part of the BC Town <type here> extension.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Florida Web Design PSL License.
 *
 * This source file is subject to the Florida Web Design PSL License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    type here
 * @version    1.0.1
 * @author     Florida Web Design LLC
 * @license    Florida Web Deisgn LLC PSL
 * @copyright  (c) 2011-2016, Cartalyst LLC
 * @link       http://cartalyst.com
 */

namespace Abcflorida\Fxwrapr\Models;

class WraprMfgModel {
    
    protected $db;
    
    protected $mf_name;
    protected $friendly_name;

    public function __construct () {
        
        $config = include "config.php";
        
        $dbconfig = $config['db'];
        
        $this->db = new \mysqli( $dbconfig['server'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database'] );
        
        echo 'let\s initialize the mysql';
        
    }
    
    public function add ( $data ) {
        echo 'add';
        
        //print_r( $this->db );
        
        $sql = "INSERT INTO Wrapr_Manufacturers (mf_name, active, wrapr_id ) VALUES ('" . $data['mf_name'] .  "', 1, 1)";
        
        $this->db->query( $sql );
        print_r ( $data );
        return true;
        
    }
    
    public function get ( $data ) {
        echo 'get';
        
    }
    
    public function remove ( $mf_id ) {
        echo 'remove';
    }
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

