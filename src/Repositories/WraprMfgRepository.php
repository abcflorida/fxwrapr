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

namespace Abcflorida\Fxwrapr\Repositories;

use Abcflorida\Fxwrapr\Models\WraprMfgModel;


class WraprMfgRepository {
    
    protected $model;
    
    public function __construct ( WraprMfgModel $model ) {
        
        $this->model = $model;
        
    }
    
    public function createModel ( $model ) {
        $this->model = $model;
    }
    
    /**
     * 
     * @param array $data match the fields that are in the model
     * @throws Exception
     */     
    public function addManufacturer ( $data ) {
        
        try {
            $prepared_fields =  $this->prepare( $data );

            if ( $prepared_fields ) {


               // $sql = "INSERT INTO Wrapr_Manufacturers (mf_name, active) VALUES ('" . $data['mf_name'] .  "', 1)";

                if ( $this->model->add( $data ) ) {
                    echo "New record created successfully";
                } else {
                    echo "Error:<br>" . $this->model->error;
                }

                //$this->model->close();

            } 
        }
        catch ( Exception $e ) { 
            throw new Exception ( $e->getMessage(), $e->getCode() );
        }
        
    }
    
    public function prepare ( $data ) {
        
        return $data;
        
    }
    
}
