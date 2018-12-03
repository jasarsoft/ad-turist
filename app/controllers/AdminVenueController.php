<?php
    /**
     * Klasa kontrolera admin panela aplikacije za rad sa lokacijama
     */
    class AdminVenueController extends AdminController {
        /**
         * Indeks metod admin kontrolera za rad sa smjestajnim kapacitetaima
         * spisak svih smjestajnih kapaciteta
         */
        public function index() {
            $this->set('venues', VenueModel::getAll());
        }
        
        /**
         * Ovaj metod prikazuje formular za dodavanje ili vrsi dodavanje 
         * ako su podaci poslati HTTP POST metodi
         * @return void
         */
        public function add() {
            $this->set('locations', LocationModel::getAll());
            $this->set('categories', VenueCategoryModel::getAll());
            $this->set('tags', TagModel::getAll());
            
            if (empty($_POST)) return;
            
            $title = filter_input(INPUT_POST, 'title');
            $slug = filter_input(INPUT_POST, 'slug');
            $short_text = filter_input(INPUT_POST, 'short_text');
            $long_text = filter_input(INPUT_POST, 'long_text');
            $price = floatval(filter_input(INPUT_POST, 'price'));
            
            $location_id = filter_input(INPUT_POST, 'location_id', FILTER_SANITIZE_NUMBER_INT);
            $venue_category_id = filter_input(INPUT_POST, 'venue_category_id', FILTER_SANITIZE_NUMBER_INT);
            
            $data = [
                'title' => $title,
                'slug' => $slug,
                'short_text' => $short_text,
                'long_text' => $long_text,
                'price' => $price,
                'location_id' => $location_id,
                'venue_category_id' => $venue_category_id,
                'user_id' => Session::get('user_id')
            ];
   
            $venue_id = VenueModel::add($data);
            
            if ($venue_id) {
                $tag_ids = filter_input(INPUT_POST, 'tag_ids', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
                
                foreach ($tag_ids as $tag_id) {
                    VenueModel::addTagToVenue($venue_id, $tag_id);
                }
                
                Misc::redirect('admin/venues/');
            } else {
                $this->set('message', 'Doslo je do greske prilikom dodavanja smjestajnog kapaciteta u bazu.');
            }
        }
        
         /**
         * Ovaj metod prikazuje formular za izmjenu ili vrsi izmjenu 
         * ako su podaci poslati HTTP POST metodi
         * @return void
         */
        public function edit($id) {
            $this->set('locations', LocationModel::getAll());
            $this->set('categories', VenueCategoryModel::getAll());
            $this->set('tags', TagModel::getAll());
            
            $venue = VenueModel::getById($id); #TODO: venue
            
            if (!isset($venue)) {
                Misc::redirect('admin/venues/');
            }
            
            $venue->tags = VenueModel::getTagsForVenueId($id);
            $venue->tag_ids = [];
            foreach ($venue->tags as $tag) {
                $venue->tag_ids[] = $tag->tag_id;
            }
            
            $this->set('venue', $venue);
            
            if (empty($_POST)) return;
            
            $title = filter_input(INPUT_POST, 'title');
            $slug = filter_input(INPUT_POST, 'slug');
            $short_text = filter_input(INPUT_POST, 'short_text');
            $long_text = filter_input(INPUT_POST, 'long_text');
            $price = floatval(filter_input(INPUT_POST, 'price'));
            
            $location_id = filter_input(INPUT_POST, 'location_id', FILTER_SANITIZE_NUMBER_INT);
            $venue_category_id = filter_input(INPUT_POST, 'venue_category_id', FILTER_SANITIZE_NUMBER_INT);
            
            $data = [
                'title' => $title,
                'slug' => $slug,
                'short_text' => $short_text,
                'long_text' => $long_text,
                'price' => $price,
                'location_id' => $location_id,
                'venue_category_id' => $venue_category_id
            ];
            
            $res = VenueModel::edit($id, $data);
            
            $tag_ids = filter_input(INPUT_POST, 'tag_ids', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
            
            VenueModel::deleteAllTags($id);
            if (is_array($tag_ids) || is_object($tag_ids)) {
                foreach ($tag_ids as $tag_id) {
                    VenueModel::addTagToVenue($id, $tag_id);
                }
            }
            
            
            if ($res) {
                Misc::redirect('admin/venues/');
            } else {
                $this->set('message', 'Doslo je do greske prilikom izmjene podataka o smjestajnom kapacitetu.');
            }
        }
    }
