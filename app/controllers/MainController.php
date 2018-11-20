<?php
    /**
     * Osnovni kontroler aplikacije koji se koristi za izvrsavanje
     * zahtjeva upuceni proema podrazumjevnim rutama koje poznaje sajt.
     */
    class MainController extends Controller {
        /**
         * Ovaj metod prepisuje podrazumjevni index metod kontrolera i njegova
         * uloga je da provjeri da li postoji prijavljeni korisnik u sesiji.
         * Ako ne postoji, metod preusmjerava posetioce na stranicu za odjavu
         * Stranica za odjavu ce izvrsiti logout metodo ovog kontrolera, koji ce
         * na kraju kada ocisti sesiju da preusmjeri posetioca na login stranu.
         */
        public function index() {
            if (!Session::exists('user_id')) {
                Misc::redirect('logout');
            }
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
            
            $venues = VenueModel::getVenuesByVenueCategoryId($category->venue_category_id);
            $this->set('venues', $venues);
        }
    }
