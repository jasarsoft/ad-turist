<?php
    /**
     * Klasa kontrolera admin panela aplikacije za rad sa kategorijama smjestajni kapaciteta
     */
    class AdminVenueCategoryController extends AdminController {
        /**
         * Indeks metod admin kontrolera za rad sa kategorijama prikazuje
         * spisak svih kategorija
         */
        public function index() {
            $this->set('categories', VenueCategoryModel::getAll());
        }
        
        /**
         * Ovaj metod prikazuje formular za dodavanje ili vrsi dodavanje 
         * ako su podaci poslati HTTP POST metodi
         * @return void
         */
        public function add() {
            if (empty($_POST)) return;
            
            $name = filter_input(INPUT_POST, 'name');
            $slug = filter_input(INPUT_POST, 'slug');
            
            $data = [
                'name' => $name,
                'slug' => $slug
            ];
            
            $location_id = VenueCategoryModel::add($data);
            
            if ($location_id) {
                Misc::redirect('admin/categories/');
            } else {
                $this->set('message', 'Doslo je do greske prilikom dodavanja kategorije u bazu.');
            }
        }
        
         /**
         * Ovaj metod prikazuje formular za izmjenu ili vrsi izmjenu 
         * ako su podaci poslati HTTP POST metodi
         * @return void
         */
        public function edit($id) {
            $location = VenueCategoryModel::getById($id);
            
            if (!isset($location)) {
                Misc::redirect('admin/categories/');
            }
            
            $this->set('category', $location);
            
            if (empty($_POST)) return;
            
            $name = filter_input(INPUT_POST, 'name');
            $slug = filter_input(INPUT_POST, 'slug');
            
            $data = [
                'name' => $name,
                'slug' => $slug
            ];
            
            $res = VenueCategoryModel::edit($id, $data);
            
            if ($res) {
                Misc::redirect('admin/categories/');
            } else {
                $this->set('message', 'Doslo je do greske prilikom izmjene podataka o kategoriji.');
            }
        }
    }
