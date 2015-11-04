<?php

/* 
Tietokantasovellus harjoitustyö, 2015 
Kirsi Rotstén 
 */

// Set the page title and include the header file:
define('Varastosovellus', 'Login');
include('templates/header.html');

// Print some introductory text:
print '<h2>Kirjautuminen</h2>

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Oikeellisuustarkastukset:

} else { // Display the form.

	print '<form action="login.php" method="post">
	<p>Käyttäjätunnus: <input type="text" name="user_id" size="20" /></p>
	<p>Salasana: <input type="password" name="password" size="20" /></p>
	<p><input type="submit" name="submit" value="Kirjaudu sisään!" /></p>
	</form>';

}

include('templates/footer.html'); // Need the footer.