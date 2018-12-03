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
        
        /**
         * Metod koji vrsi dodavanje zapisa lokacije u bazu podataka
         * @param string $name
         * @param string $classes
         * @return int|boolean ID broj zapisa u bazi ako je kreiran ili false ako je doslo do greske
         */
        public static function add($name, $class) {
            $SQL = 'INSERT INTO tag (name, image_class) VALUES (?, ?);';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$name, $class]);
            if ($res) {
                return DataBase::getInstance()->lastInsertId();
            } else {
                return false;
            }
        }

        /**
         * Metod koji vrsi izmjenu zapisa lokacije u bazi podataka.
         * @param int $id
         * @param string $name
         * @param string $class
         * @return boolena
         */
        public static function edit($id, $name, $class) {
            $SQL = 'UPDATE tag SET name = ?, image_class = ? WHERE tag_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            return $prep->execute([$name, $class, $id]);
        }
    }
