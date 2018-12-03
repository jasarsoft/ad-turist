<?php
    /*
     * Model koji odgovara tabeli location
     */
    class LocationModel extends Model {
        /**
         * Metod koji vrsi dodavanje zapisa lokacije u bazu podataka
         * @param string $name
         * @param string $slug
         * @return int|boolean ID broj zapisa u bazi ako je kreiran ili false ako je doslo do greske
         */
        public static function add($name, $slug) {
            $SQL = 'INSERT INTO location (name, slug) VALUES (?, ?);';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$name, $slug]);
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
         * @param string $slug
         * @return boolena
         */
        public static function edit($id, $name, $slug) {
            $SQL = 'UPDATE location SET name = ?, slug = ? WHERE location_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            return $prep->execute([$name, $slug, $id]);
        }
    }
