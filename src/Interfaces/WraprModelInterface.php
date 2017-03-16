<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Brian @ Florida Web Design
 */
namespace Abcflorida\Fxwrapr\Interfaces;

interface WraprModelInterface {
	
	/** add a model related to mfg
	* @param array $args includes name, friendly_name, sort_order, `id`, `wrapr_id`, `mf_id`, `model_name`, `meta_desc`, `page_desc`, `search_tags`, `sub_models`, `active`, `model_nameclean`, `sort_order`, `model_friendly`
	*/
	public function addModel ( $args ); 
	public function updateModel ( $model_id, $args );
	public function deleteModel ( $model_id );
	public function getAllModels ( );
	public function searchModel ( $search );
	public function searchModelJson ( $search );
	
	/** Remove all the designs linked to this model - typically used when resetting, or deleting a model 
	* @param int $model_id 
	*/
	public function removeDesignsForModel ( $model_id );
}
