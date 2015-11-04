/* 

Tietokantasovellus harjoitustyö, 2015 
Kirsi Rotstén 
 */

<?php 
/* This script receives two values from Home.html:
 * These are: käyttäjätunnus & salasana 
 * Returns the text, whether field is empty or not */

// Success-flag setting
$okay = TRUE;

// Validate the email address:
if (empty($_POST['user_id'])) {
	print '<p class="error">Anna käyttäjätunnus.</p>';
	$okay = FALSE;
}

// Validate the password:
if (empty($_POST['password'])) {
	print '<p class="error">Anna salasana.</p>';
	$okay = FALSE;
}

// If there were no errors, print a success message:
if ($okay) {
    print '<p>Onnistunut kirjautuminen.</p>';
    return TRUE;
}
else 
    print '<p>Yritä uudelleen.</p>';
    return false;
?>
</body>
</html>
