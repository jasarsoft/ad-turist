<?php
/**
 * Klasa Misc je klasa sa metodima opste namjene
 */
class Misc {
    /**
     * Ovaj metotod nadevezuje url na korijenski link
     * @param string $url
     * @return string 
     */
    public static function link($url) {
        return Configuration::BASE_URL . $url;
    }
    
    /**
     * Ovaj metod kreira jednostavna <a> tag za zadati link koji se nadovezuje
     * na osnonu putnju ka web aplikaciji, tj ovaj metod se korisit za kreiranje
     * relativnih linkova za vezivanje sadrzaja ove aplikacije.
     * @param string $url relativni dio linka koji se nadovezuje na putanju ka korijenu aplikacije
     * @param string $title Tekst koji treba prikazati ako sadrzaj linka
     * @param type $class
     */
    public static function url($url, $title, $class = '') {
        echo '<a href="' . Misc::link($url) . '" class="' . $class . '">' . htmlspecialchars($title) . '</a>';
    }
    
    /**
     * Ovaj metod se korisit za preuzmjeravanje korisnika na relativnu putanju u 
     * odnosu na korijen putanje web aplikacije na internetu.
     * @param string $url relativni dio linka koji se nadovezauje na putanju ka korijenu aplikacije
     */
    public static function redirect($url) {
        ob_clean();
        header('Location: ' . Misc::link($url));
        exit;
    }
}
