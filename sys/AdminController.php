<?php

/**
 * Ova klasa predstavlja posebnu izveneu klasu koju naslijedjuje sve osobine
 * i funkcionalnosti osnovne klase kontrolera aplikacije uz dopunu koja 
 * predstavlja provjeru prijavljenog korisnika [otvara sesiju za korisnika]
 * i ako to nije slucaj preusmjerava posjetioca na logout rutu, koja ce 
 * isprazniti sve iz sesije i preusmjerit korisnika na login rutu.
 */

class AdminController extends Controller {
    /**
     * ovaj metod vrsi provjeru postojanja prijavljenog korisnika (otvorena
     * sesija za korisnika). Ako korisnik koji prijavljen preusmjerava ga
     * na logout rutu koja ce isprazniti sve iz sesije i preusmjerit na
     * login rutu.
     */
    public final function __pre() {
        if (!Session::exists('user_id')) {
            Misc::redirect('login');
        }
    }
}
