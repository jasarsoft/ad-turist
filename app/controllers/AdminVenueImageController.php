<?php

class AdminVenueImageController extends AdminController {
    
    public function index() {
        //code
    }
    
    public function listVenueImages($venue_id) {
        $this->set('images', ImageModel::getByVenueId($venue_id));
        $this->set('venue_id', $venue_id);
    }
    
    public function uploadImage($venue_id) {
        $this->set('venue_id', $venue_id);
        
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
        
        if ($mimeType != 'image/jpeg') {
            $this->set('message', 'Dozvoljeno je dodavanje samo JPG slika.');
            return;
        }
        
        #Slika hostela u Beogradu   123
        //$baseName = basename($originalName);
        $baseName = strtolower($originalName);
        $baseName = preg_replace('[^a-z0-9\- ]', '', $baseName);
        $baseName = preg_replace(' +', '-', $baseName);
        #slika-hostela-u-beogradu-123
        
        $fileName = date('YmdHisu') . '-' . $baseName . '.jpg';
        
        $newLocation = Configuration::IMAGE_DATA_PATH . $fileName;
        
        $res = move_uploaded_file($temporaryPath, $newLocation);
        if ( !isset($res) ) {
            $this->set('message', 'Doslo je do greske prilikom cuvanja fajla na krajnu lokaciju. Nemate privilegije na direktoriju.');
            return;
        }
        
        $data = [
            'path' => $newLocation,
            'venue_id' => $venue_id
        ];
        
        $res = ImageModel::add($data);
        if ( !$res ) {
            $this->set('message', 'Doslo je do greske prilikom upisa u bazu podataka.');
            return;
        }
        
        Misc::redirect('admin/images/venue/' . $venue_id);
    }
}
