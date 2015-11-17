<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author rotsten
 */
class UserController extends BaseController{
    
    public static function kirjaudu(){
       View::make('User/Kirjaudu.html');
    }
    
    public function authenticate ($kayttajatunnus, $salasana) {
 
    $query = DB::connection()->prepare('SELECT * FROM KAYTTAJA WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
    $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
    $row = $query->fetch();
    if($row){
      $found_kayttaja = new Kayttaja(array(
          'kayttajatunnus' => $row['kayttajatunnus'],
          'salasana' => $row['salasana'],
          'etunimi' => $row['etunimi'],
          'sukunimi' => $row['sukunimi'],
          'kayttooikeudet' => $row['kayttooikeudet']
        ));
      return $found_kayttaja;
    }
    else{
      return null;
    } // end of if-else
  } // end of authenticate

  public static function handle_login (){

   /* 
    * This function receives two values from Login.html:
    * These are: käyttäjätunnus & salasana 
    * Returns the text, whether fields are empty or not.
    * Later add also other mechanisms to check the validity of the inputs... 
    */
      
    $params = $_POST;
    //$annettu_kayttajatunnus=$_POST['kayttajatunnus'];
    //$annettu_salasana      =$_POST['salasana'];
    
    // Success-flag setting
    $okay = TRUE;
   
    // Tsekkaa antoiko käyttäjä käyttäjätunnuksen:
    if (empty($params['kayttajatunnus'])){
       print '<p class="error">Anna käyttäjätunnus.</p>';
       $okay = FALSE;
    }
    
    // Tsekkaa antoiko käyttäjä salasanan:   
    if (empty($params['salasana'])){
       print '<p class="error">Anna salasana.</p>';
       $okay = FALSE;
    }
    
    /*
    if (empty($submit['salasana'])) {
            print '<p class="error">Anna salasana.</p>';
            $okay = FALSE;
    }*/
    if ($okay) {
       //$user = Kayttaja::authenticate($annettu_kayttajatunnus, $annettu_salasana);
       $user = UserController::authenticate($params['kayttajatunnus'], $params['salasana']);

      if(!$user){
          View::make('User/Kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['kayttajatunnus']));
      } else{
          $_SESSION['kayttajatunnus'] = $user->kayttajatunnus;

          Redirect::to('/Paasivu', array('message' => 'Tervetuloa takaisin ' . $user->etunimi . '!'));
      } // the end of function
    } // the end of function
  } // the end of handle_login()

}
