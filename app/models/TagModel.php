<?php
    /*
     * Model koji odgovara tabeli tag
     */
    class TagModel extends Model {
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
