<?php
    /*
     * Model koji odgovara tabeli location
     */
    class LocationModel {
        /*
         * Metod koji vraca spisak svih lokacija poredani po imenu
         */
        public static function getAll() {
            $SQL = 'SELECT * FROM location ORDER BY `name`;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute();
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }

        /*
         * Metod koji vraca objekat sa podacima lokacije ciji location_id je dat kao argument metode
         */
        public static function getById($id) {
            $id = intval($id);
            $SQL = 'SELECT * FROM location WHERE location_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return null;
            }
        }
    }
