<?php
    /*
     * Model koji odgovara tabeli venue
     */
    class VenueModel {
        /**
         * Ovaj metod vraca spisak smjestanih kapaciteta iz baze i koristi sistem paginacije;
         * Stranica $page se koristi da se izracuna pocetni indeks rezultata odakle pocinje;
         * priprema zapisa koji ce biti vraceni, a zavisi od konstante Configuration::ITEM_PER_PAGE
         * @param int $page
         * @return array
         */
        public static function getAllPaged($page) {
            $page = max(0, $page);
            $first = $page * Configuration::ITEM_PER_PAGE;
            $SQL = 'SELECT * FROM venue ORDER BY `title` LIMIT ?, ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$first, Configuration::ITEM_PER_PAGE]);
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
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
        
        /**
         * Metod koji vraca objekat sa podacima smjestajnog kapciteta ciji slug je dat kao argumnet metoda
         * @param string $slug
         * @return stdClass
         */
        public static function getBySlug($slug) {
            $SQL = 'SELECT * FROM venue WHERE slug = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$slug]);
            if ($res) {
                return $prep->fetch(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }
        
        /**
         * Metod vrsi unos nove stavke u bazu podatak za smjesajni prostor
         * @param type $title
         * @param type $slug
         * @param type $short_text
         * @param type $long_text
         * @param type $price
         * @param type $location_id
         * @param type $venue_category_id
         * @return boolean|ing ID broj smjestajnog prostora ili FALSE u slucaju greske
         */
        public static function add($title, $slug, $short_text, $long_text, $price, $location_id, $venue_category_id, $user_id) {
            $SQL = 'INSERT INTO venue (`title`, slug, short_text, long_text, price, location_id, venue_category_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?);';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$title, $slug, $short_text, $long_text, $price, $location_id, $venue_category_id, $user_id]);
            if ($res) {
                return DataBase::getInstance()->lastInsertId();
            } else {
                return false;
            }
        }

        /**
         * Metod mjenja sadrzaj zapisa u bazi podataka za izabrani smjestajni prostor
         * @param type $id
         * @param type $title
         * @param type $slug
         * @param type $short_text
         * @param type $long_text
         * @param type $price
         * @param type $location_id
         * @param type $venue_category_id
         * @return boolean 
         */
        public static function edit($id, $title, $slug, $short_text, $long_text, $price, $location_id, $venue_category_id) {
            $SQL = 'UPDATE venue SET `title` = ?, slug = ?, short_text = ?, long_text = ?, price = ?, location_id = ?, venue_category_id = ? WHERE venue_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            return $prep->execute([$title, $slug, $short_text, $long_text, $price, $location_id, $venue_category_id, $id]);
        }
        
        /**
         * Metod dodjeljuje odabrani tag u odabrani smjestajni prostor
         * @param int $venue_id
         * @param int $tag_id
         * @return boolean
         */
        public static function addTagToVenue($venue_id, $tag_id) {
            $SQL = 'INSERT INTO venue_tag (venue_id, tag_id) VALUES (?, ?);';
            $prep = DataBase::getInstance()->prepare($SQL);
            return $prep->execute([$venue_id, $tag_id]);
        }
        
        /**
         * Brise sve tagove koji su bili dodjeljeni ovom smjestajnom prostoru
         * @param int $venue_id
         * @return boolean | int
         */
        public static function deleteAllTags($venue_id) {
            $SQL = 'DELETE FROM venue_tag WHERE venue_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            return $prep->execute([$venue_id]);
        }
        
        /**
         * Metod vraca spisak slika za odredjeni smjestajni prostor
         * @param int $venue_id
         * @return array
         */
        public static function getVenueImage($venue_id) {
            $SQL = 'SELECT * FROM image WHERE venue_id = ?;';
            $prep = DataBase::getInstance()->prepare($SQL);
            $res = $prep->execute([$venue_id]);
            if ($res) {
                return $prep->fetchAll(PDO::FETCH_OBJ);
            } else {
                return [];
            }
        }
        
        /**
         * Metod vraca rezultate pretrage po datim kriterijima.
         * @param int $location_id
         * @param int $venue_category_id
         * @param array $tag_ids
         * @return array
         */
        public static function homePageSearch($location_id, $venue_category_id, $tag_ids) {
            if ($location_id != -1 and $venue_category_id != -1 and count($tag_ids) > 0) {
                $tag_placeholders = [];
                for ($i = 0; $i < count($tag_ids); $i++) {
                    $tag_placeholders = '?';
                }
                $tag_placeholders_string = implode(', ', $tag_placeholders);
                
                $SQL = 'SELECT * ' .
                       'FROM venue ' . 
                       'WHERE location_id = ? AND venue_category_id = ? AND venue_id IN(' .
                            'SELECT venue_id ' .
                            'FROM venue_tag ' .
                            'WHERE tag_id IN (' . $tag_placeholders_string . ')' .
                        ') ' .
                        'ORDER BY `title`';
                
                $prep = DataBase::getInstance()->prepare($SQL);
                
                $niz = [
                    $location_id,
                    $venue_category_id
                ];
                $niz = array_merge($niz, $tag_ids);
                $prep->execute($niz);
                return $prep->fetchAll(PDO::FETCH_OBJ);
                
            }
            
            if ($location_id == -1 and $venue_category_id != -1 and count($tag_ids) > 0) {
                $tag_placeholders = [];
                for ($i = 0; $i < count($tag_ids); $i++) {
                    $tag_placeholders = '?';
                }
                $tag_placeholders_string = implode(', ', $tag_placeholders);
                
                $SQL = 'SELECT * ' .
                       'FROM venue ' . 
                       'WHERE venue_category_id = ? AND venue_id IN(' .
                            'SELECT venue_id ' .
                            'FROM venue_tag ' .
                            'WHERE tag_id IN (' . $tag_placeholders_string . ')' .
                        ') ' .
                        'ORDER BY `title`';
                
                $prep = DataBase::getInstance()->prepare($SQL);
                
                $niz = [
                    $venue_category_id
                ];
                $niz = array_merge($niz, $tag_ids);
                $prep->execute($niz);
                return $prep->fetchAll(PDO::FETCH_OBJ);
                
            }
            
            if ($location_id != -1 and $venue_category_id == -1 and count($tag_ids) > 0) {
                $tag_placeholders = [];
                for ($i = 0; $i < count($tag_ids); $i++) {
                    $tag_placeholders = '?';
                }
                $tag_placeholders_string = implode(', ', $tag_placeholders);
                
                $SQL = 'SELECT * ' .
                       'FROM venue ' . 
                       'WHERE location_id = ? AND venue_id IN(' .
                            'SELECT venue_id ' .
                            'FROM venue_tag ' .
                            'WHERE tag_id IN (' . $tag_placeholders_string . ')' .
                        ') ' .
                        'ORDER BY `title`';
                
                $prep = DataBase::getInstance()->prepare($SQL);
                
                $niz = [
                    $location_id
                ];
                $niz = array_merge($niz, $tag_ids);
                $prep->execute($niz);
                return $prep->fetchAll(PDO::FETCH_OBJ);
                
            }
            
            if ($location_id == -1 and $venue_category_id == -1 and count($tag_ids) > 0) {
                $tag_placeholders = [];
                for ($i = 0; $i < count($tag_ids); $i++) {
                    $tag_placeholders = '?';
                }
                $tag_placeholders_string = implode(', ', $tag_placeholders);
                
                $SQL = 'SELECT * ' .
                       'FROM venue ' . 
                       'WHERE venue_id IN(' .
                            'SELECT venue_id ' .
                            'FROM venue_tag ' .
                            'WHERE tag_id IN (' . $tag_placeholders_string . ')' .
                        ') ' .
                        'ORDER BY `title`';
                
                $prep = DataBase::getInstance()->prepare($SQL);
                $prep->execute($tag_ids);
                return $prep->fetchAll(PDO::FETCH_OBJ);
                
            }
            
            if ($location_id != -1 and $venue_category_id != -1 and count($tag_ids) == 0) {
                
                $SQL =  'SELECT * ' .
                        'FROM venue ' . 
                        'WHERE location_id = ? AND venue_category_id = ? ' .
                        'ORDER BY `title`';
                
                $prep = DataBase::getInstance()->prepare($SQL);
                
                $niz = [
                    $location_id,
                    $venue_category_id
                ];

                $prep->execute($niz);
                return $prep->fetchAll(PDO::FETCH_OBJ);                
            }
            
            if ($location_id == -1 and $venue_category_id != -1 and count($tag_ids) == 0) {
                
                $SQL =  'SELECT * ' .
                        'FROM venue ' . 
                        'WHERE venue_category_id = ? ' .
                        'ORDER BY `title`';
                
                $prep = DataBase::getInstance()->prepare($SQL);
                
                $niz = [
                    $venue_category_id
                ];

                $prep->execute($niz);
                return $prep->fetchAll(PDO::FETCH_OBJ);                
            }
            
            if ($location_id != -1 and $venue_category_id == -1 and count($tag_ids) == 0) {
                
                $SQL =  'SELECT * ' .
                        'FROM venue ' . 
                        'WHERE location_id = ? ' .
                        'ORDER BY `title`';
                
                $prep = DataBase::getInstance()->prepare($SQL);
                
                $niz = [
                    $location_id
                ];

                $prep->execute($niz);
                return $prep->fetchAll(PDO::FETCH_OBJ);                
            }
            
            if ($location_id == -1 and $venue_category_id == -1 and count($tag_ids) == 0) {
                return self::getAll();
            }
        }
    }
