<?php
    /*
     * Model koji odgovara tabeli location
     */
    class LocationModel {
        /*
         * Metod koji vraca spisak svih lokacija poredani po imenu
         */
        public static function getAll() {
            $SQL = 'SELECT * FROM location ORDER BY `name`;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute();
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }

        /*
         * Metod koji vraca objekat sa podacima lokacije ciji location_id je dat kao argument metode
         */
        public static function getById($id) {
            $id = intval($id);
            $SQL = 'SELECT * FROM location WHERE location_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return null;
            }
        }

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
