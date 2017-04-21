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
 * In this interface, the db may be tightly coupled to the business logic because it makes sense at this point for ease of implementation
 *
 * @package    fxwrapr
 * @version    1.0.1
 * @author     Florida Web Design LLC
 * @license    Florida Web Deisgn LLC PSL
 * @copyright  (c) 2011-2016, Cartalyst LLC
 * @link       http://github.com/abc.florida
 */

namespace  Abcflorida\Fxwrapr\Interfaces;


/** Main wrapr table - snowmobile, motobike, utv
 * Site_ID is important so that we know which site stores what wraprs.  This is not critical for this version because we are only supporting one site, but in order to scale for utv and moto this is important
 * 
*/
interface WraprInterface {
    
    /** add a wrapr
     * 
     * @param type $args  `id`- ai,`site_id, `wrapr_name`, `wrapr_vehicle`,`wrapr_layers`, -- not needed?? `active`, `style`, `instructions_base`,`icon`,`deleted`,`friendly_name`,`file_prefix`,`wrapr_key_name`
     * @return int $wrapr_id | Exception 
     */
    public function addWrapr ( $args );
    
    
    /** update values
     * 
     * @param type $wrapr_id
     * @param type $args `site_id, `wrapr_name`, `wrapr_vehicle`,`wrapr_layers`, -- not needed?? `active`, `style`, `instructions_base`,`icon`,`deleted`,`friendly_name`,`file_prefix`,`wrap_key_name`
     * @return boolean|Exception
     */
    public function updateWrapr ( $wrapr_id, $args );
    
    
    /** removeWrapr - no hard deletes
     * Set the activeflag = 0
     * @param int $wrapr_id
     * @return boolean
     */
    public function removeWrapr ( $wrapr_id );
    
    
    /** get wrapr by id
     * 
     * @param int $wrapr_id
     * @return array|Exception
     */
    public function getWrapr ( $wrapr_id );
    
    /** get wraprs by site_id
     * 
     * @param int $site_id
     * @return array|Exception
     */
    public function getWraprs ( $site_id );
    
}

/* This is to manage manufactures
 * Could be the wrapr_manufacturers, but could also be some other data base
 */
interface WraprMfgInterface {

	/** Add manufacturer 
	* @param array $args includes `mf_id`, `wrapr_id`, `mf_name`, `isMenuItem`, `isAffiliateItem`, `sort_order` 
         * @return int $mf_id
	*/
	public function addMfg ( $args ); 
	
	/** Update manufacturer
	* @param int $mfg_id 
	* @param array $args
        * @return boolean|Exception
	*/
	public function updateMfg ( $mfg_id, $args );
	
	/** Delete manufacturer
	* @param int $mfg_id 
        * @return boolean|Exception
	*/
	public function deleteMfg ( $mfg_id );
	
        /**
         * 
         * @param int $wrapr_id
         * @return array|Exception
         */
	public function getMfgs ( $wrapr_id );
}

interface WraprModel {
	
	/** add a model related to mfg
	* @param array $args includes name, friendly_name, sort_order, `id`, `wrapr_id`, `mf_id`, `model_name`, `meta_desc`, `page_desc`, `search_tags`, `sub_models`, `active`, `model_nameclean`, `sort_order`, `model_friendly`
        * @return int @model_id|Exception
	*/
	public function addModel ( $args ); 
        
        /**
         * 
         * @param int $model_id
         * @param array $args
         * @return boolean|Exception
         */
	public function updateModel ( $model_id, $args );
        
        /** soft deletes a model
         * 
         * @param int $model_id
         * @return boolean|Exception 
         */
	public function deleteModel ( $model_id );
        
        /** returns model from model_id or name
         * 
         * @param int $arg if is_int than its a model_id else its a name.  Probably need to do safe search on string.
         * @return array|Exception
         */
        public function getModel ( $arg );
        
        /** returns array of models
         * @param int $wrapr_id the wrapr_id of the app
         * @return array|Exception all model ids, and name "model_id","model_name_friendly","model_name","active"
         */
	public function getModelsByWrapr ( $wrapr_id );
        
        /** returns array of models by manufacturer
         * Pass in arguments for sorting, filtering
         * @param int $mf_id
         * @return array|Exception
         * 
         */
        public function getModelsByManufacturer ( $mf_id, $args );
        
        /* search model by name or year 
         * Pass params in for wildcard search type $search['wild']
         * @param string $search expects to contain fieldnames of table or view
         * @return array|Exception
         */
	public function searchModel ( $search );
	
	/** Remove all the designs linked to this model - typically used when resetting, or deleting a model 
	* @param int $model_id 
	*/
	public function removeDesignsForModel ( $model_id );
        

}


/* wraprsubmodel 
 * Submodel consists of excluded layers, active, date, tracklength.  model_id is the foreign key for this model
 *  */
interface WraprSubmodel  {

        /** add submodel "model_id, submodel_name, submodel_name_friendly */
	public function addSubmodel ( $args );
	
	public function updateSubmodel ( $submodel_id, $args );
	
	public function removeSubModel ( $submodel_id );
	
        /** appends year to the list with a delimiter.  
         * Delimiter can be specified and that will be used to separate the years in the databasae.  The an adapter will turn it into json
         * @param int $submodel_id
         * @param string @args should include $years as an array or a list with the added param $delimiter
         * @returns true or error message true|"error processing request : year is not valid"
        */
	public function addYearToSubmodel ( $submodel_id, $args );
	
        /** make submodel year active/deactive
         * 
         * @param int $submodel_id
         * @param array $args active,year or active,submodel_year_id
         */
        public function activateSubmodelYear ( $submodel_id, $args );
        
        /**
         * @param int $model_id
         * @return array|Exception
        */
        public function getSubmodelsByModel ( $model_id );
        	
}


interface WraprSubmodelYears {

	/** addSubmodelYear
         * 
         * @param int $submodel_id
         * @param int $year_id
         */
        public function addSubmodelYear ( $submodel_id, $year_id );
        
        
        /** Soft delete a submodel year
         * 
         * @param int $submodel_id
         * @param int $year_id
         */
	public function removeSubmodelYear ( $submodel_id, $year_id );
	

        /** add a color from the main palette 
         * @param int $submodel_id pk
         * @param string $year 
         * @param int $layer_id 
         * @param string $colors list of colorids  
        */
	public function addColorsToPalette( $submodel_id, $year, $layer_id, $colors );
        
        /** Remove a color from a submodel year layer palette
         * @param int $submodel_id pk
         * @param string $year 
         * @param int $layer_id 
         * @param string $colors list of colorids  
         *          */
	public function removeColorsFromPalette( $submodel_id, $year, $layer_id, $colors );
	
        /** copySubmodelExclusions copies all the color layers from the selected submodel to the new submodel
         * 
         * @param int $submodel_id
         * @param int $copy_submodel_id
        */
	public function copySubmodelYearPalette ( $submodel_id, $year, $copy_submodel_id );
        
	/** Gets the active years that are assigned to the submodel.  This is for generating select and info boxes 
	* @param int $submodel_id
        * @param array $args [active]
	* @return array
	*/
	public function getSubmodelYears ( $submodel_id, $args );
	
	/** update the year value for a submodel
         * 
         * @param type $submodel_year_id
         * @param type $args fields => value to be updated
         */
        public function updateSubmodelYears ( $submodel_year_id, $args );
        
	
}

/** 
 * This allows management of the most granular levele of color controls
 */
Interface WraprSubmodelYearLayersColors {
    
    /** add colors for exclusion
     * 
     * @param int $submodel_year_id
     * @param int|array $layer_id
     * @param int|array $colors
     */
    public function addSubmodelYearLayerColors ( $submodel_year_id, $layer_id, $colors );
    
    /** Update excluded colors 
     * 
     * @param int $submodel_year_id
     * @param int|array $layer_id
     * @param int|array $colors
     */
    public function updateSubmodelYearLayers ( $submodel_year_id, $layer_id, $colors );  
    
    /** remove excluded colors
     * 
     * @param int $submodel_year_id
     * @param int|array $layer_id
     * @param int|array $colors
    */
    public function deleteSubmodelYearLayerColors ( $submodel_year_id, $layer_id, $colors );
    
    /** Get the total palette for a submodel year layer \
     * 
     * @param type $submodel_year_id
     * @param type $submodel_id
     * @param type $year
     * @param type $layer
     */
    public function getSubmodelYearLayerPalette ( $submodel_year_id, $submodel_id, $year, $layer );
    
}


/** WraprLayer is part of a colorway - colorway is the total layer/color that make up a design
 * Wrapr layers represent the potential layer available for the design to store.  So, a design may have panel layers, design layers and logo layers.  There may be 
 * 4 panel layers, 4 design layers, and 1 logo layer ( based on submodel_year ).  The wrapr must have at least 9 layers to represent this model/design configuration.
 */
interface WraprLayer {
    
        /** add a layer to the wrapr
         * 
         * @param array $args is an array including layer_name, layer_name_friendly,layer_type, active.
         */
	public function addLayer ( $args );
        
        /** update the layer information
         * layer_type is either image, static, or dynamic.  In this version we are not going to save the images dynamically, but we need to be able to distinguish between
         * the logo layers and others so layer_type is still required.  Please it will make upgrading easier in the future
         * 
         * @param int $layer_id
         * @param array $args
         */
	public function updateLayer ( $layer_id, $args );
        
        /** soft deletes a layer
         * 
         * @param type $layer_id
         */
	public function deleteLayer ( $layer_id );
        
        /** assigns hasMany relationship 
         * 
         * @param int $layer_id
         * @param int $design_id
         */
	public function assignLayerToDesign ( $layer_id, $design_id );
        
        /** Soft delete the layer from the design
         * 
         * @param int $layer_id
         * @param int $design_id
         */
	public function removeLayerFromDesign ( $layer_id, $design_id );
        
        /** returns the layers assigned to a wrapr 
         * "wrapr_name, layer_name, layer_friendly_name, active, last_update_dt".
         * return array 
         * 
        */
        public function getLayersByWrapr ( $wrapr_id, $args ); 
        
        /**
         * 
         * @param int|array $layer_id
        */
        public function getLayersById ( $layer_id );
        
        
}

interface WraprSubmodelYear {
    
    /** add submodel year - this is the entity that relates to the pallete at the most granular level
     * 
     * @param array $args "submodel_id, year, active "
     */
    public function addSubmodelYear ( $args );
    
    /** 
     * 
     * @param int $submodel_year_id
     * @param array $args
     */
    public function updateSubmodelYear ( $submodel_year_id, $args );
    
    /** softdelete the submodel year
     * 
     * @param int $submodel_year_id
     * @param array $args
     */
    public function removeSubmodelYear ( $submodel_year_id, $args );
    
}

interface WraprSubmodelYearLayer { 
    
    
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
	*/
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