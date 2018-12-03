<?php

/**
 * Osnovna klasa svih modela
 */
abstract class Model /*implements ModelInterface*/ {
    /**
     * Metod vraca ime tabele na osnovu imena klase modela
     * @return string
     */
    protected final static function getTableName() {
//        $className = get_called_class();                                        # VenueCategoryModel
//        $underscoredName = preg_replace('/([A-Z])/', '_$0', $className);        # _Venue_Category_Model
//        $lowerCaseName = strtolower($underscoredName);                          # _venue_category_model
//        return substr($lowerCaseName, 1, -6);                                   # venue_category
        
        return substr(strtolower(preg_replace('/([A-Z])/', '_$0', get_called_class())), 1, -6);  
    }
    
    /**
     * Metod koji vraca spisak svih stavki iz tabele ovog modela
     * @return array
     */
    public final static function getAll() {
        $tableName = self::getTableName();
        $SQL = 'SELECT * FROM ' . $tableName . ';';
        $prep = DataBase::getInstance()->prepare($SQL);
        $res = $prep->execute();
        if ($res) {
            return $prep->fetchAll(PDO::FETCH_OBJ);
        } else {
            return [];
        }
    }
    
    /**
     * Metod koji vraca objekat sa podacima zapisa iz tabele ovog modela koji ima vrijednost primarnog kljuca dat kao argument $id;
     * @param int $id
     * @return stdClass
     */
    public final static function getById($id) {
        $id = intval($id);
        $tableName = self::getTableName();
        $SQL = 'SELECT * FROM ' . $tableName . ' WHERE ' . $tableName . '_id = ?;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $res = $prep->execute([$id]);
        if ($res) {
            return $prep->fetch(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }
}
