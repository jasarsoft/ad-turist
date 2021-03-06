<?php
    /**
     * Klasa kontrolera admin panela aplikacije za rad sa lokacijama
     */
    class AdminLocationController extends AdminController {
        /**
         * Indeks metod admin kontrolera za rad sa lokacijama prikazuje
         * spisak svih lokacija
         */
        public function index() {
            $this->set('locations', LocationModel::getAll());
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
            
            $location_id = LocationModel::add($data);
                        
            if ($location_id) {
                Misc::redirect('admin/locations/');
            } else {
                $this->set('message', 'Doslo je do greske prilikom dodavanja lokacije u bazu.');
            }
        }
        
         /**
         * Ovaj metod prikazuje formular za izmjenu ili vrsi izmjenu 
         * ako su podaci poslati HTTP POST metodi
         * @return void
         */
        public function edit($id) {
            $location = LocationModel::getById($id);
            
            if (!isset($location)) {
                Misc::redirect('admin/locations/');
            }
            
            $this->set('location', $location);
            
            if (empty($_POST)) return;
            
            $name = filter_input(INPUT_POST, 'name');
            $slug = filter_input(INPUT_POST, 'slug');
            
            $data = [
                'name' => $name,
                'slug' => $slug
            ];
            
            $res = LocationModel::edit($id, $data);
            
            if ($res) {
                Misc::redirect('admin/locations/');
            } else {
                $this->set('message', 'Doslo je do greske prilikom izmjene lokacije u bazu.');
            }
        }
    }
