<?php

/**
 * Osnovna klasa svih modela
 */
abstract class Model /*implements ModelInterface*/ {
    protected final static function getTableName() {
        $className = get_called_class();                                        # VenueCategoryModel
        $underscoredName = preg_replace('/([A-Z])/', '_$0', $className);        # _Venue_Category_Model
        $lowerCaseName = strtolower($underscoredName);                          # _venue_category_model
        return substr($lowerCaseName, 1, -6);                                   # venue_category
    }
    
    public final static function getAll() {
        
    }
    
    public final static function getById($id) {
        
    }
}
