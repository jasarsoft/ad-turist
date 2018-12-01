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
            
            if (!isset($_POST)) return;
            
            $title = filter_input(INPUT_POST, 'title');
            $slug = filter_input(INPUT_POST, 'slug');
            $short_text = filter_input(INPUT_POST, 'short_text');
            $long_text = filter_input(INPUT_POST, 'long_text');
            $price = floatval(filter_input(INPUT_POST, 'price'));
            
            $location_id = filter_input(INPUT_POST, 'location_id', FILTER_SANITIZE_NUMBER_INT);
            $venue_category_id = filter_input(INPUT_POST, 'venue_category_id', FILTER_SANITIZE_NUMBER_INT);
   
            $venue_id = VenueModel::add($title, $slug, $short_text, $long_text, $price, $location_id, $venue_category_id, Session::get('user_id'));
            
            if ($venue_id) {
                $tag_ids = filter_input(INPUT_POST, 'tag_ids', FILTER_REQUIRE_ARRAY);
                
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
            
            $this->set('venue', $venue);
            
            if (!isset($_POST)) return;
            
            $$title = filter_input(INPUT_POST, 'title');
            $slug = filter_input(INPUT_POST, 'slug');
            $short_text = filter_input(INPUT_POST, 'short_text');
            $long_text = filter_input(INPUT_POST, 'long_text');
            $price = floatval(filter_input(INPUT_POST, 'price'));
            
            $location_id = filter_input(INPUT_POST, 'location_id', FILTER_SANITIZE_NUMBER_INT);
            $venue_category_id = filter_input(INPUT_POST, 'venue_category_id', FILTER_SANITIZE_NUMBER_INT);
            
            $res = VenueModel::edit($id, $title, $slug, $short_text, $long_text, $price, $location_id, $venue_category_id);
            
            if ($res) {
                Misc::redirect('admin/venues/');
            } else {
                $this->set('message', 'Doslo je do greske prilikom izmjene podataka o smjestajnom kapacitetu.');
            }
        }
    }
