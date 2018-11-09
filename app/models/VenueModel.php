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
        
        /**
         * Metod vraca niz objekata sa podacima o tagovima koji su dodjeljeni
         * smjestajnom kapacitetu ciji ID broj je prosljedjen kao argumnet
         * @param int $id ID broj smjestajnih kapaciteta
         * @return array
         */
        public static function getTagsForVenueId($id) {
            $id = intval($id);
            $SQL = 'SELECT * FROM venue_tag WHERE venue_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                $spisak = $prep->fetchAll(PDO::FETCH_OBJ);
                $list = [];
                foreach ($spisak as $item) {
                    $list[] = TagModel::getById($item->tag_id);
                }
                return $list;
            } else {
                return null;
            }
        }
        
        /**
         * Metod koji vraca niz objekata sa podacima smjestajnih kapaciteta koji 
         * spajaju pod kategoriju ciji ID broj je dat kao argument
         * @param int $id
         * @return array
         */
        public static function getVenuesByVenueCategoryId($id) {
            $SQL = 'SELECT * FROM venue WHERE venue_category_id = ? ORDER BY `title`;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }
    }
