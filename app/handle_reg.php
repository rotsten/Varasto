/* 

Tietokantasovellus harjoitustyö, 2015 
Kirsi Rotstén 
 */

<?php // This script receives two values from register.html:
/* käyttäjätunnus, salasana, submit */

// Success-flag setting
$okay = TRUE;

// If there were no errors, print a success message:
if ($okay) {
    print '<p>Onnistunut kirjautuminen.</p>';
}
else 
    print '<p>Yritä uudelleen.</p>';
?>
</body>
</html>
