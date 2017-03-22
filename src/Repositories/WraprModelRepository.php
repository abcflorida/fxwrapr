<?php

/**
 * WraprModel.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Florida Web Design PSL License.
 *
 * This source file is subject to the Florida Web Design PSL License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    fxwrapr
 * @version    1.0.1
 * @author     Florida Web Design LLC
 * @license    Florida Web Deisgn LLC PSL
 * @copyright  (c) 2011-2016, Cartalyst LLC
 * @link       http://github.com/abc.florida
 */

namespace  Abcflorida\Fxwrapr\Repositories;

use Abcflorida\Fxwrapr\Interfaces\WraprModelInterface;

class WraprModelRepository implements WraprModelInterface {
    
        public function __construct ( $db ) {
            echo 'init';
            $this->db = $db;
            
        }
	
	/** add a model related to mfg
	* @param array $args includes name, friendly_name, sort_order, `id`, `wrapr_id`, `mf_id`, `model_name`, `meta_desc`, `page_desc`, `search_tags`, `sub_models`, `active`, `model_nameclean`, `sort_order`, `model_friendly`
	*/
	public function addModel ( $args )  {
            
            $sql = "insert into wrapr_modelinfo ( model_id, model_name ) values ( ?, ?)";
            //echo 'test';
            $stmt = $this->db->prepare($sql);
            
            $stmt->bind_param( "is", 1, 'test' );
            
            /* Execute the statement */
            $stmt->execute();
            
            if ($stmt->error) {
               printf("Errormessage: %s\n", $stmt->error);
            }
               

            /* close statement */
            $stmt->close();
            
           
            
        } 
        
	public function updateModel ( $model_id, $args )
        {
            
        }
                
	public function deleteModel ( $model_id )
        {
            
        }
        
	public function getAllModels ( )
        {
            
        }
        
	public function searchModel ( $search )
        {
            
        }
        
	public function searchModelJson ( $search )
        {
            
        }
	
	/** Remove all the designs linked to this model - typically used when resetting, or deleting a model 
	* @param int $model_id 
	*/
	public function removeDesignsForModel ( $model_id ) {
            
        }
}
