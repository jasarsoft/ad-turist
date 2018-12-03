<?php
/*
 * Model koji odgovara tabeli user login
 */
class UserModel extends Model { 
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
