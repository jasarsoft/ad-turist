<?php
    /**
     * Klasa kontrolera admin panela aplikacije za rad sa tagovima
     */
    class AdminTagController extends AdminController {
        /**
         * Indeks metod admin kontrolera za rad sa takove prikazuje
         * spisak svih lokacija
         */
        public function index() {
            $this->set('tags', TagModel::getAll());
        }
        
        /**
         * Ovaj metod prikazuje formular za dodavanje ili vrsi dodavanje 
         * ako su podaci poslati HTTP POST metodi
         * @return void
         */
        public function add() {
            if (!isset($_POST)) return;
            
            $name = filter_input(INPUT_POST, 'name');
            $image_class = filter_input(INPUT_POST, 'image_class');
            
            $tag_id = TagModel::add($name, $image_class);
            
            if ($tag_id) {
                Misc::redirect('admin/tags/');
            } else {
                $this->set('message', 'Doslo je do greske prilikom dodavanja taga u bazu.');
            }
        }
        
         /**
         * Ovaj metod prikazuje formular za izmjenu ili vrsi izmjenu 
         * ako su podaci poslati HTTP POST metodi
         * @return void
         */
        public function edit($id) {
            $tag = TagModel::getById($id);
            
            if (!isset($tag)) {
                Misc::redirect('admin/tags/');
            }
            
            $this->set('tag', $tag);
            
            if (!isset($_POST)) return;
            
            $name = filter_input(INPUT_POST, 'name');
            $image_class = filter_input(INPUT_POST, 'image_class');
            
            $res = TagModel::edit($id, $name, $image_class);
            
            if ($res) {
                Misc::redirect('admin/tags/');
            } else {
                $this->set('message', 'Doslo je do greske prilikom izmjene taga u bazu.');
            }
        }
    }