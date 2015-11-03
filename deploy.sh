#!/bin/bash

# Missä kansiossa komento suoritetaan
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

source $DIR/config/environment.sh

echo "Siirretään tiedostot users-palvelimelle..."

# Tämä komento siirtää tiedostot palvelimelta
scp -r app config lib vendor sql assets index.php composer.json rotsten@users.cs.helsinki.fi:htdocs/Varasto

echo "Valmis!"

echo "Suoritetaan komento php composer.phar dump-autoload..."

# Suoritetaan php composer.phar dump-autoload
ssh rotsten@users.cs.helsinki.fi "
cd htdocs/Varasto
php composer.phar dump-autoload
exit"

echo "Valmis! Sovelluksesi on nyt valmiina osoitteessa rotsten.users.cs.helsinki.fi/Varasto"
