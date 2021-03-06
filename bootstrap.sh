#!/bin/bash

source config/environment.sh

echo "Luodaan projektikansio..."

# Luodaan projektin kansio
ssh $rotsten@users.cs.helsinki.fi "
cd htdocs
touch favicon.ico
//mkdir $Varasto
cd $Varasto
touch .htaccess
echo 'RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]' > .htaccess
exit"

echo "Valmis!"

echo "Siirretään tiedostot users-palvelimelle..."

# Siirretään tiedostot palvelimelle
scp -r app config lib vendor sql assets index.php composer.json rotsten@users.cs.helsinki.fi:htdocs/Varasto

echo "Valmis!"

echo "Asetetaan käyttöoikeudet ja asennetaan Composer..."

# Asetetaan oikeudet ja asennetaan Composer
ssh $rotsten@users.cs.helsinki.fi "
chmod -R a+rX htdocs
cd htdocs/$Varasto
curl -sS https://getcomposer.org/installer | php
php composer.phar install
exit"

echo "Valmis! Sovelluksesi on nyt valmiina osoitteessa rotsten.users.cs.helsinki.fi/Varasto"
