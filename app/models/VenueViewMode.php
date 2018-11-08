<?php
    /*
     * Model koji odgovara tabeli venue_view
     */
    class VenueViewModel {
        /**
         * Metod koji vraca spisak svih pregleda smjestanih kapaciteta poredani 
         * po datumu u opadajucem redosljedu
         * @return array
         */
        public static function getAll() {
            $SQL = 'SELECT * FROM venue_view ORDER BY `datetime` DESC;';
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
            $SQL = 'SELECT * FROM venue_view WHERE venue_view_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return null;
            }
        }
        
        /**
         * Metod vraca niz objekata sa podaci o pregledima smjestanih kapaciteta
         * ciji ID broj je dat kao argument
         * @param int $id ID broj smjestajnog kapaciteta
         * @return array
         */
        public static function getByVenueId($id) {
            $id = intval($id);
            $SQL = 'SELECT * FROM venue_view WHERE venue_id = ? ORDER BY `datetime` DESC;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return null;
            } 
        }
    }
