<?php
/**
 * Ovaj interfejs navodi sve metode koji obavezno moraju da budu implementirani
 * u svakoj klasi koja predstavlja model za tabele u bazi podataka aplikacije
 */
class ModelInterface {
    
    /**
     * Ovaj metod vraca sve zapise iz baze podataka za tabelu ciji je ovo model;
     * Svi slogovi iz tabele poredani su po prirodnom redosljedu za ovu tabelu;
     */
    public static function getAll();
    
    /**
     * Ovaj metod vraca jedan slog iz tabele ciji je ovo model, a ciji je primarni
     * kljuc vrijednost koja je data kao argument $id ovog metoda;
     * @param int $id Vrijednost primarnog kljuca sloga koji treba vratiti;
     */
    public static function getById($id);
    
    /**
     * Metod koji daje stavku sa podacima datim u nizu u adekvatnu tabelu u bazi;
     * @param array $data 
     * @return int Vrijednost primarnog kljuca za novi zapis u tabeli;
     */
    public static function add(array $data);
    
    /**
     * Ovaj metod mjenja podatke iz data niza na zapisu tabele pod ID broje $id
     * @param int $id 
     * @param array $data 
     * @return boolean Vraca true ako je uspjesan upit, a false ako nije;
     */
    public static function edit($id, array $data);
}
