<?php
/*
 * Model koji odgovara tabeli user login
 */
class UserModel {
    /*
     * Metod koji vraca spisak svih korisnika poredjanih po korisnickom datumu 
     * opadajucim poredkom
     */
    public static function getAll() {
        $SQL = 'SELECT * FROM user_login ORDER BY `datetime` DESC;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $res = $prep->execute();
        if ($res) {
            return $prep->fetchAll(PDO::FETCH_OBJ);
        } else {
            return [];
        }
    }

    /*
     * Metod vraca objekat sa podacima o prijavi korisnika ciji 
     * user_login_id je dat kao argument metoda
     */
    public static function getById($id) {
        $id = intval($id);
        $SQL = 'SELECT * FROM user_login WHERE user_login_id = ?;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $res = $prep->execute([$id]);
        if ($res) {
            return $prep->fetch(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }
    
    /**
     * Metod koji vraca niz prijava korisnika ciji ID je dat kao argument
     * @param int $id id korisnika
     * @return array
     */
    public static function getByUserId($id) {
        $id = intval($id);
        $SQL = 'SELECT * FROM user_login WHERE user_id = ? ORDER BY `datetime` DECS;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $res = $prep->execute([$id]);
        if ($res) {
            return $prep->fetchAll(PDO::FETCH_OBJ);
        } else {
            return null;
        } 
    }
}
