<?php
    /*
     * Model koji odgovara tabeli venue_category
     */
    class VenueCategoryModel {
        /**
         * Metod koji vraca spisak svih kategorija smjestanih kapaciteta poredani po imenu
         * @return array
         */
        public static function getAll() {
            $SQL = 'SELECT * FROM venue_category ORDER BY `name`;';
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
         * @return stdClass | NULL
         */
        public static function getById($id) {
            $id = intval($id);
            $SQL = 'SELECT * FROM venue_category WHERE venue_category_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$id]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return null;
            }
        }
        
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
        
        /**
         * Metod koji vrsi dodavanje zapisa kategorije u bazu podataka
         * @param string $name
         * @param string $slug
         * @return int|boolean ID broj zapisa u bazi ako je kreiran ili false ako je doslo do greske
         */
        public static function add($name, $slug) {
            $SQL = 'INSERT INTO venue_category (name, slug) VALUES (?, ?);';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$name, $slug]);
            if ($res) {
                return DataBase::getInstance()->lastInsertId();
            } else {
                return false;
            }
        }

        /**
         * Metod koji vrsi izmjenu zapisa kategorije u bazi podataka.
         * @param int $id
         * @param string $name
         * @param string $slug
         * @return boolena
         */
        public static function edit($id, $name, $slug) {
            $SQL = 'UPDATE venue_category SET name = ?, slug = ? WHERE venue_category_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            return $prep->execute([$name, $slug, $id]);
        }
    }
