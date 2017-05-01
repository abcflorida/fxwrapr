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

namespace Abcflorida\Fxwrapr\Controllers;

use Abcflorida\Fxwrapr\Interfaces\WraprMfgInterface;
use Abcflorida\Fxwrapr\Repositories\WraprMfgRepository;

class Wrapr implements  WraprMfgInterface {
    
    public function __construct ( Repository $repo ) {}
    
    public function getMfgs($wrapr_id, $args) {
        
    }
    
    public function addMfg($args) {
        
    }
    
    public function deleteMfg($mfg_id) {
        
    }
    
    public function updateMfg($mfg_id, $args) {
        
    }
    
    
    
}