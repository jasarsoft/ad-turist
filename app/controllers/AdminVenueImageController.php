<?php

class AdminVenueImageController extends AdminController {
    
    public function index() {
        //code
    }
    
    public function listVenueImages($venue_id) {
        $this->set('images', ImageModel::getByVenueId($venue_id));
    }
    
    public function uploadImage($venue_id) {
        if (!$_FILES or !isset($_FILES['image'])) return;
        
        if ($_FILES['image']['error'] != 0) {
            $this->set('message', 'Doslo je do greske prilikom dodavanja fajla!');
            return;
        }
        
        $temporaryPath = $_FILES['image']['tmp_name'];
        $fileSize      = $_FILES['image']['size'];
        $originalName  = $_FILES['image']['name'];
        
        if ($fileSize > 300*1024) {
            $this->set('message', 'Fajl koji dodajete je veci od maksimalno dozvoljene velicine od 300KB.');
            return;
        }
        
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($temporaryPath);
        
        if ($mimeType != 'image/jpg') {
            $this->set('message', 'Dozvoljeno je dodavanje samo JPG slika.');
            return;
        }
        
        #Slika hostela u Beogradu   123
        $basename = basename($originalName);
        $basename = strtolower($basename);
        $basename = preg_replace('[^a-z0-9\- ]', '', $basename);
        $basename = preg_replace(' +', '-', $basename);
        #slika-hostela-u-beogradu-123
        
        $filename = date('YmdHisu') . '-' . $basename . '.jpg';
        
        $newLocation = Configuration::IMAGE_DATA_PATH . $filename;
        
        $res = move_uploaded_file($temporaryPath, $newLocation);
        if ( !isset($res) ) {
            $this->set('message', 'Doslo je do greske prilikom cuvanja fajla na krajnu lokaciju. Nemate privilegije na direktoriju.');
            return;
        }
        
        $res = ImageModel::add($newLocation, $venue_id);
        if ( !$res ) {
            $this->set('message', 'Doslo je do greske prilikom upisa u bazu podataka.');
            return;
        }
        
        Misc::redirect('admin/images/venue/', $venue_id);
    }
}
