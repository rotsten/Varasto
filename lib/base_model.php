<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    /*
     * Lisätään annettujen syötteiden validointifunktiot.
     *    -validate_tuote_id(), 
     *    -validate_tuotteen_nimi(), 
     *    -validate_valmistaja(), 
     *    -validate_lukumaara()
     */

    public function validate_tuote_id(){
        
      /* Tarkistaa, onko annettu merkkijono sisältää vain numeroita.
       * Merkkijonon pitää olla ainakin 5 merkkiä pitkä.
       */
        
       $errors_tuote_id = array();
       if($this.tuote_id == '' || $this.tuote_id == null){
           $errors_tuote_id[] = 'Tuote-id on pakollinen tieto!';
       }
       if(strlen($this.tuote_id) < 5){
         $errors_tuote_id[] = 'Tuote_id:n pitää olla vähintään 5 merkkiä pitkä!';
       } 
       
       // tarkistaa, että sisältää vain numeroita
       if (is_digit($this.tuote_id)) {
           if ($this.tuote_id < 0) {
             $errors_tuote_id[] = 'Tuote-id on aina positiivinen kokonaisluku!'; 
           }
        } else {
            $errors_tuote_id[] = 'Tuote-id ei saa sisältää muita merkkejä kuin numeroita!';
        }  
       
       return $errors_tuote_id[];
    }
              
    public function validate_tuotteen_nimi(){
        
      /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
       * Esimerkiksi merkkijonon pitää olla ainakin 3 merkkiä
       * pitkä.
       */
        
       $errors_tuotteen_nimi = array();
       if($this.tuotteen_nimi == '' || $this.tuotteen_nimi == null){
           $errors_tuotteen_nimi[] = 'Jätit tiedon antamatta!';
       }
       if(strlen($this.tuotteen_nimi) < 3){
         $errors_tuotteen_nimi[] = 'Tuotteen nimen pitää olla vähintään 3 merkkiä pitkä!';
       }                                   
       return $errors_tuotteen_nimi[];
    }
    
    public function validate_valmistaja(){
        
      /* Tarkistaa, onko annettu merkkijono oikeanmittainen.
       * Esimerkiksi merkkijonon pitää olla ainakin 3 merkkiä
       * pitkä.
       */
        
       $errors_valmistaja = array();
       if($this.valmistaja == '' || $this.valmistaja == null){
           $errors_valmistaja[] = 'Jätit tiedon antamatta!';
       }
       if(strlen($this.valmistaja) < 2){
         $errors_valmistaja[] = 'Tuotteen valmistajan nimen pitää olla vähintään 2 merkkiä pitkä!';
       }                                   
       return $errors_valmistaja[];
    }
    
    public function validate_lukumaara(){
        
      /* Tarkistaa, onko annettu merkkijono sisältää vain numeroita.
       * Lukumäärän antaminen ei ole välttämätöntä.
       */
        
       $errors_lukumaara = array();
      
       // tarkistaa, että sisältää vain numeroita
       if (is_digit($this.tuote_id)) {
           if ($this.tuote_id < 0) {
             $errors_lukumaara[] = 'lukumäärä on aina positiivinen kokonaisluku!'; 
           }
        } else {
            $errors_lukumaara[] = 'Lukumäärä ei saa sisältää muita merkkejä kuin numeroita!';
        }  
       
       return $errors_lukumaara[];
    }
            
    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
      $errors = array_merge($errors, $errors_tuote_id, $errors_tuotteen_nimi, 
        $errors_valmistaja, $errors_lukumaara);

      foreach($this->validators as $validator){
          $errors_temp = $this->{{% validator %}}();.
          validate_tuote_id(), 
     validate_tuotteen_nimi(), 
     validate_valmistaja(), 
     validate_lukumaara()
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      }

      return $errors;
    }

  }
