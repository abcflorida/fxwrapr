<?php

/**
 * WraprInterface.
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

namespace  Abcflorida\Fxwrapr\Interfaces;

interface WraprInterface {

	/** Add manufacturer 
	* @param array $args includes `mf_id`, `wrapr_id`, `mf_name`, `isMenuItem`, `isAffiliateItem`, `sort_order` 
	*/
	public function addMfg ( $args ); 
	
	/** Update manufacturer
	* @param int $mfg_id 
	* @param array $args
	*/
	public function updateMfg ( $mfg_id, $args );
	
	/** Delete manufacturer
	* @param int $mfg_id 
	*/
	public function deleteMfg ( $mfg_id );
	
	public function getMfgs ( $wrapr_id );
}

interface WraprModel {
	
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

interface WraprDesign {
	
	/** Add a design 
	*
	* a design is like "Rogue" and it has color layers and logo layers ( which are stored at the submodel level.
	* @param array $args includes `id`,`wrapr_id`,`title`,`meta_desc`,`page_desc`,`search_tags`,`active`,`design_order`
	*/
	public function addDesign ( $args );
	
	/**  updatedesign
	*
	* @param int $design_id
	* @param array $args
	*/
	public function updateDesign ( $design_id, $args );
	
	/** Deletes a design 
	*
	* @param int $design_id
	*/
	public function deleteDesign ( $design_id );
	
	/** Inserts a layer into the wrapr_designs_layers table
	* layer_color is no longer needed because the colors are all inclusive to begin with and we exclude colors based on model, design and submodel layer
	* @param int $design_id
	* @param int $layer_id
	* @param int $layer_order
	* /
	public function addLayerToDesign ( $design_id, $layer_id, $layer_order );
	
	/** Removes layer from design 
	* 
	* @param int $design_id
	* @param int $layer_id
	*/
	public function removeLayerFromDesign ( $design_id, $layer_id );
	
	/** add entry to the models_designs table
	* MobileFriendly was used to specify whether the system had a small image for the wrap and therefore could use certain blocks of code.
	* @param int $design_id
	* @param int $model_id
	* @param int $mobileFriendly
	*/  
	public function assignDesignToModel( $design_id, $model_id );
	
	/** Remove one design from a linked model
	*/
	public function removeDesignFromModel ( $design_id, $model_id );
	public function getAllDesigns ( );
	public function searchDesigns ( $search );
	public function searchDesignslJson ( $search );
}

interface WraprLayer {
	public function addLayer ( $args );
	public function updateLayer ( $layer_id, $args );
	public function deleteLayer ( $layer_id );
	public function assignLayerToDesign ( $layer_id, $design_id );
	public function removeLayerFromDesign ( $layer_id, $design_id );
}

interface SubmodelYears {

	public function addSubmodelYear ( $submodel_id, $year_id );
	public function removeSubmodelYear ( $submodel_id, $year_id );
	
	/** this is only created if there is an exclusion for the layer 
	* @param int $submodel_id
	* @param int $year_id
	* @param int $layer_id
	* @returns boolean
	*/
	public function addSubmodelYearLayer ( $submodel_id, $year_id, $layer_id );
	
	/** this is only needed if there is an exclusion added to the submodel year for a layer in the design
	* @param int $submodel_id
	* @param int $year_id
	* @param int $layer_id
	* @returns boolean T|F
	*/
	public function removeSubmodelYearLayer ( $submodel_id, $year_id, $layer_id );
	
	/** Gets the years that are assigned to the submodel.  This is for generating select and info boxes 
	* @param int $submodel_id
	* @return array
	*/
	public function getYearsForSubmodel ( $submodel_id );
	
	/** update the year value for a submodel
	public function updateYear
	public function removeYear

	/** returns the color exclusions for the submodel_layer combination
	* @param int $submodel_id
	* @param int $layer_id 
	* returns array 
	*/
	public function getSubmodelYearExclusions ( $submodel_id, $layer_id );
}

interface WraprSubmodel {

	public function addSubmodel ( $args );
	
	public function updateSubmodel ( $submodel_id, $args );
	
	public function removeSubModel ( $submodel_id );
	
	// public function addYearToSubmodel ( $submodel_id, args );
	
	public function excludeColorsFromPalette( $submodel_id, $layer_id, $colors );
	
	public function copySubmodelExclusions ( $submodel_id, $copy_submodel_id );
	
}

interface WraprSubmodelLayer {

	public function addSubmodelLayer ( $args );
	
	public function removeSubmodelLayer ( $submodel_id, $layer_id );
	
	public function updateSubmodelLayer( $submodelid, $layer_id, $colors );
}

interface WraprApp {
	
	/** returns array( 'name','mfg','model','submodel','year','hasLogos') */
	public function getWrap ( $wrap_id );
	
	public function setDesignId ( $wrap_id );
	
	public function setCurrentLayer ( $wrap_id, $layer_id );	
	
	public function getWrapButtons ( $wrap_id );
	
	public function getWrapLayers ( $wrap_id );
	
	public function getPalettes ( $wrap_id );

	/** This could be cached for all layers when the app loads or it can be called dynamically.
	* If layerid is null then we should return an array with all the layers
	* @param int $wrap_id 
	 */
	public function getLayerPalette ( $design_id, $layer_id = null );
	
	/** Returns an array of filter names that can represent buttons or lists
	*
	* @param int $wrapr_id 
	*/
	public function getPaletteFilters ( $wrapr_id );
	
	/** returns an array of colors for the layer after removing colors based on model, design, and submodel_year selection
	* 
	* @param int $design_id
	* @param int $model_id
	* @param int $submodel_year_id
	* @param int $layer_id
	*/
	public function getPaletteFiltered ( $design_id, $model_id, $submodel_year_id, $layer_id);
	
	/** Returns a subset of colors based on the palette filter
	*
	* @param int $filter_id
	*/
	public function getColorsFiltered ( $filter_id );
	
	/** returns the image path for designs selected layer color 
	*
	* @param int $design_id
	* @param int $layer_id
	* @param string $color if it's cast as int then it's an id, else it's color_name??
	*/
	public function getLayerColorImage ( $design_id, $layer_id, $color );
	
	/** returns an assoc array consisting of layername, color
	*
	* @param int $wrap_id
	*/
	public function getWrapLayerColorsOriginal ( $wrap_id );
	

	/** returns the available logo layer info for this wrap
	* When a design is loaded, it could have logo set buttons in the designer.  This should return the html partials when the degign is initially loaded because it won't change after being loaded the first time 
	* @param int $wrap_id
	*/
	public function getLogoLayerButtons ( $wrap_id );

	/** Adds wrap to the wrapr_userdesigns table and wrapr_images table.
	* @param int $design_id 
	* @param int $submodel_id
	* @param array $args should include $args( array( 'layer_id','value' ) )
	* returns int $wrap_id
	*/
	public function saveWrap ( $design_id, $submodel_id, $args );
	
	
	/** updates the wrapr_design colors
	* @param array $params form elements from the post that includes layer=>value == "layer1"=>"1"
	*/
	public function updateWrapLayerColors ( $params );

}