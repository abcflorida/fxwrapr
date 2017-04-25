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
 * @package    FxWrapr
 * @version    1.0.1
 * @author     Florida Web Design LLC
 * @license    Florida Web Deisgn LLC PSL
 * @copyright  (c) 2012-2017, Florida Web Design LLC
 * @link       http://flwebdesignservice.com
 */

namespace Abcflorida\Fxwrapr\Interfaces;

interface WraprApplicationInterface {
    
    /**
     * 
     * @param array $args
     * @return array|Exception
    */
    public function getPrimaryPalette ( $args );
    
    /** 
     * 
     * @param array $args [design_id, is_ajax]
     * @return array|Exception
    */
    public function getPalettes ( $args );
    
    /** 
     * 
     * @param array $args [design_id, layer_id, palette_id, submodel_year_id, is_ajax ]
     * @return array|Exception [layer_color_name, layer_color_hex, layer_color_order ][{{"yellow":"#xxx"},{"blue","#bbb"}}]
    */
    public function getPalette ( $args );
    
    /** 
    * 
    * @param array $args [ design_id, is_ajax ]
    * @return array|Exception [ design_id, layer_id, layer_order, layer_color, layer_color_name, layer_image, layer_type ]
    */    
    public function getDesign ( $args );
    
    public function getLayer ( $args );
    
    public function refreshDesign ( $args );
    
    /** 
     * 
     * @param array $args [design_id]
     */
    public function getProductUrl ( $args );
    
    public function getImagePath ( $design_id );
    
    /** Buttons include the layer group buttons, logo buttons, palette buttons, etc 
     * 
     * @param int $design_id
    */
    public function getDesignButtons ( $design_id );
    
    /** 
    *  
    */
    public function createDesign ( $args );
    
    /** 
     * 
     * @param array $args [ design_id, model_id, submodel_year_id, year, [attributes] ]
     */    
    public function addToCart ( $args );
    
    
}

