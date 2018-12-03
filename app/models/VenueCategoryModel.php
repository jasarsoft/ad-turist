<?php
    /*
     * Model koji odgovara tabeli venue_category
     */
    class VenueCategoryModel extends Model {
        /**
         * Metod koji vraca objekat sa podacima smjestanog kapaciteta (objekta) ciji
         * je slug dat kao argument metode
         * @param int $slug
         * @return stdClass | NULL
         */
        public static function getBySlug($slug) {
            $SQL = 'SELECT * FROM venue_category WHERE slug = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return null;
            } 
        }
    }
