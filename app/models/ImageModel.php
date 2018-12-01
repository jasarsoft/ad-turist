<?php
    /*
     * Model koji odgovara tabeli image
     */
    class ImageModel {
        /*
         * Metod koji vraca spisak svih slika poredani po id broju
         */
        public static function getAll() {
            $SQL = 'SELECT * FROM image ORDER BY `name`;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute();
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }

        /*
         * Metod koji vraca objekat sa podacima slike ciji image_id je dat kao argument metode
         */
        public static function getById($id) {
            $image_id = intval($id);
            $SQL = 'SELECT * FROM image WHERE image_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$image_id]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return null;
            }
        }
        
        /**
         * Metod vraca niz objekata sa podacima slika koji pripadaju oderdjenom smjestajnom prostoru
         * @param int $venue_id
         * @return array
         */
        public static function getByVenueId($venue_id) {
            $id = intval($venue_id);
            $SQL = 'SELECT * FROM image WHERE venue_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return null;
            }
        }
        
        /**
         * Metod dodaje sliku za izabrani smjestajni kapacitet sa datom lokacjom slike
         * @param string $path
         * @param int $venue_id
         * @return boolean
         */
        public static function add($path, $venue_id) {
            $SQL = 'INSERT INTO image (path, venue_id) VALUES (?, ?);';
            $prep = DataBase::getInstance()->prepare($SQL);
            return $prep->execute([$path, $venue_id]);
            
        }
    }
