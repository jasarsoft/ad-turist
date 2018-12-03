<?php
    /*
     * Model koji odgovara tabeli venue_view
     */
    class VenueViewModel extends Model {        
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
