<?php
    /**
     * Osnovni kontroler aplikacije koji se koristi za izvrsavanje
     * zahtjeva upuceni proema podrazumjevnim rutama koje poznaje sajt.
     */
    class MainController extends Controller {
        /**
         * Osnovni metod pocetne stranice sajta
         */
        public function index($page = 0) {
            $this->set('categories', VenueCategoryModel::getAll());
            
            $venues = VenueModel::getAllPaged($page);
            for ($i=0; $i < count($venues); $i++) {
                $venues[$i]->images = VenueModel::getVenueImage($venues[$i]->venue_id);
                $venues[$i]->tags   = VenueModel::getTagsForVenueId($venues[$i]->venue_id);
            }
            
            $this->set('venues', $venues);
        }
        
        /**
         * Ovaj metod provjera da li postoje podaci za prijavu poslati HTTP POST
         * metodom, vrsi njihovu validaciju, provjera postojanje korisnika sa tim
         * pritstupnim parametrima i u slicaju da sve provjere prodju bez greske
         * metod kreira sesiju za korisnika i preusmjerava korisnika na default rutu.
         */
        public function login() {
            if (!empty($_POST)) {
                $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

                $hash = hash('sha512', $password . Configuration::USER_SALT);
                unset($password);

                $user = UserModel::getByUsernameAndPasswordHash($username, $hash);
                unset($hash);

                if ($user) {
                    Session::set('user_id', $user->user_id);
                    Session::set('username', $username);
                    Session::set('ip', filter_input(INPUT_SERVER, 'REMOTE_ADDR'));
                    Session::set('ua', filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING));

                    Misc::redirect('');
                } else {
                    $this->set('message', 'Nisu dobri login parametri.');
                    sleep(1);
                }
            }
        }
        
        /**
         * Ovaj metod gasi sesiju cime efektivno unistava sve u sesiji
         * a zatim preusmjerava korisnika na stranicu za prijavu na login rutu
         */
        public function logout() {
            Session::end();
            Misc::redirect('login');
        }
        
        /**
         * Metod koji salje view spisak smjestanih kapaciteta za kategoriju za datim slug
         * @param string $categorySlug
         * @return type
         */
        public function listByCategory($categorySlug){
            $category = VenueCategoryModel::getBySlug($categorySlug);
            
            if (!$category) {
                Misc::redirect('');
            }
            
            $this->set('categories', VenueCategoryModel::getAll());
            
            $venues = VenueModel::getVenuesByVenueCategoryId($category->venue_category_id);
            
            for ($i=0; $i < count($venues); $i++) {
                $venues[$i]->images = VenueModel::getVenueImage($venues[$i]->venue_id);
                $venues[$i]->tags   = VenueModel::getTagsForVenueId($venues[$i]->venue_id);
            }
            
            $this->set('venues', $venues);
            $this->set('category', $category);
        }
        
        public function venue($slug) {
            $venue = VenueModel::getBySlug($slug);
            
            if (!$venue) {
                Misc::redirect('');
            }
            
            $this->set('categories', VenueCategoryModel::getAll());
            
            $venue->images = VenueModel::getVenueImage($venue->venue_id);
            $venue->tags   = VenueModel::getTagsForVenueId($venue->venue_id);
            
            $this->set('venue', $venue);
        }
    }
