<?php
    /*
     * Model koji odgovara tabeli tag
     */
    class TagModel {
        /*
         * Metod koji vraca spisak svih tagova poredani po imenu
         */
        public static function getAll() {
            $SQL = 'SELECT * FROM tag ORDER BY `name`;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute();
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }

        /*
         * Metod koji vraca objekat sa podacima taga ciji tag_id je dat kao argument metode
         */
        public static function getById($id) {
            $id = intval($id);
            $SQL = 'SELECT * FROM tag WHERE tag_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return null;
            }
        }
        
        /**
         * Metod vraca niz objekata koji sadrze podatke o smjestejnim
         * kapacitetima koji su obiljezeni tagom ciji ID broj je dat kao
         * argument metoda
         * @param int $id ID broj taga
         * @return array
         */
        public static function getVenuesForTagId($id) {
            $id = intval($id);
            $SQL = 'SELECT * FROM venue_tag WHERE tag_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                $spisak = $prep->fetchAll(PDO::FETCH_OBJ);
                $list = [];
                foreach ($spisak as $item) {
                    $list[] = VenueModel::getById($item->venue_id);
                }
                return $list;
            } else {
                return null;
            }
        }
    }
