<?php

/* 
 * Tietokantasovellus harjoitustyö, 2015 
*  Kirsi Rotstén 
 *
 * This script receives two values from Home.html:
 * These are: käyttäjätunnus & salasana 
 * Returns the text, whether fields are empty or not.
 * Later add also other mechanisms to check the validity of the inputs... 
 */

function handle_login ($submit){

    // Success-flag setting
    $okay = TRUE;
   
    // Tsekkaa antoiko käyttäjä käyttäjätunnuksen:
    if (empty($submit['user_id'])) {
            print '<p class="error">Anna käyttäjätunnus.</p>';
            $okay = FALSE;
    }

    // Tsekkaa antoiko käyttäjä salasanan:
    if (empty($submit['password'])) {
            print '<p class="error">Anna salasana.</p>';
            $okay = FALSE;
    }
    /* Pitäisi tarkastella Käyttäjä-taulun tiedoista myös, löytyykö käyttäjä */

    if ($okay) {
        // print '<p>Onnistunut kirjautuminen.</p>';
        $query = DB::connection()->prepare ('SELECT * KAYTTAJA WHERE kayttajatunnus = $kayttajatunnus and salasana = $salasana;');
        return TRUE;
    }
    else
    {
        //print '<p>Yritä uudelleen.</p>';
        return FALSE;
    } // end of if-else
} // end of function
  
