<?php

/**
 * Osnovna klasa svih modela
 */
abstract class Model implements ModelInterface {
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
    
     /**
     * Metod koji daje stavku sa podacima datim u nizu u adekvatnu tabelu u bazi;
     * @param array $data 
     * @return int|boolean Vrijednost primarnog kljuca za novi zapis u tabeli ili FALSE ako doslo do greske
     */
    public static function add(array $data) {
        $tableName = self::getTableName();
        $nizImenaPolja = [];
        $nizPlaceholdera = [];
        $nizVrijednosti = [];
        
        foreach ($data as $imePolja => $vrijednostPolja) {
            if (preg_match('/^[a-z][a-z0-9\_]*$/', $imePolja) and $imePolja != $tableName . '_id') {
                if (is_object($vrijednostPolja) or is_array($vrijednostPolja)) {
                    continue;
                }
                
                $nizImenaPolja = $imePolja;
                $nizPlaceholdera = '?';
                $nizVrijednosti = $vrijednostPolja;
            }
        }
        
        $spisakPolja = implode(', ', $nizImenaPolja);
        $spisakUpitnika = implode(', ', $nizPlaceholdera);
        
        $SQL = 'INSERT INTO ' . $tableName . ' (' . $spisakPolja . ') VALUES (' . $spisakUpitnika . ');';
        $prep = DataBase::getInstance()->prepare($SQL);
        if ($prep) {
            $res = $prep->execute($nizVrijednosti);
            if ($res) {
                return DataBase::getInstance()->lastInsertId();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
     /**
     * Ovaj metod mjenja podatke iz data niza na zapisu tabele pod ID broje $id
     * @param int $id 
     * @param array $data 
     * @return boolean Vraca true ako je uspjesan upit, a false ako nije;
     */
    public static function edit(int $id, array $data) {
        $tableName = self::getTableName();
        $nizPromjena = [];
        $nizVrijednosti = [];
        
        foreach ($data as $imePolja => $vrijednostPolja) {
            if (preg_match('/^[a-z][a-z0-9\_]*$/', $imePolja) and $imePolja != $tableName . '_id') {
                if (is_object($vrijednostPolja) or is_array($vrijednostPolja)) {
                    continue;
                }
                
                $nizPromjena = $imePolja . ' = ?';
                $nizVrijednosti = $vrijednostPolja;
            }
        }
        
        $spisakPromjena = implode(', ', $nizPromjena);
        
        $SQL = 'UPDATE ' . $tableName . ' SET ' . $spisakPromjena . ' WHERE ' . $tableName . '_id = ?;';
        $prep = DataBase::getInstance()->prepare($SQL);
        if ($prep) {
            $nizVrijednosti[] = $id;
            return $prep->execute($nizVrijednosti);
        } else {
            return FALSE;
        }
    }
}
