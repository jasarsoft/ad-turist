<?php
class UserModel extends Model {
    /**
     * Metod koji vraca objekat sa podacima korisnika cije koisnicko ime i hes lozinka su dati kao argumenti metoda;
     * @param string $username
     * @param string $passwordHash
     * @return stdClass | null
     */
    public static function getByUsernameAndPasswordHash($username, $passwordHash) {
        $SQL = 'SELECT * FROM user WHERE `username` = ? AND `password` = ? AND active = 1;';
        $prep = DataBase::getInstance()->prepare($SQL);
        $res = $prep->execute([$username, $passwordHash]);
        if ($res) {
            return $prep->fetch(PDO::FETCH_OBJ);
        } else {
            return null;
        }
    }
}
