<?php
    /*
     * Model koji odgovara tabeli venue
     */
    class VenueModel {
        /*
         * Metod koji vraca spisak svih smjestanih kapaciteta (objekata)  poredani po imenu
         */
        public static function getAll() {
            $SQL = 'SELECT * FROM venue ORDER BY `title`;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute();
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }

        /*
         * Metod koji vraca objekat sa podacima smjestajnih kapaciteta (objekata) ciji venue_id je dat kao argument metode
         */
        public static function getById($id) {
            $id = intval($id);
            $SQL = 'SELECT * FROM venue WHERE venue_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return null;
            }
        }
    }
