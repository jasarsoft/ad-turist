<?php
    /*
     * Model koji odgovara tabeli image
     */
    class ImageModel extends Model {        
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
    }
