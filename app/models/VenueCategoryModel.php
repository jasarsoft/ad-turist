<?php
    /*
     * Model koji odgovara tabeli venue_category
     */
    class VenueCategoryModel {
        /**
         * Metod koji vraca spisak svih kategorija smjestanih kapaciteta poredani po imenu
         * @return array
         */
        public static function getAll() {
            $SQL = 'SELECT * FROM venue_category ORDER BY `name`;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute();
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }

        /**
         * Metod koji vraca objekat sa podacima smjestanog kapaciteta (objekta) ciji
         * je venue_category_id dat kao argument metode
         * @param int $id
         * @return array
         */
        public static function getById($id) {
            $id = intval($id);
            $SQL = 'SELECT * FROM venue_category WHERE venue_category_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return null;
            }
        }
    }
