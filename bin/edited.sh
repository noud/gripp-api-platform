#!/usr/bin/env sh
cp src/Admin/BedrijfAdmin.php.dist src/Admin/BedrijfAdmin.php
cp src/Admin/PakketAdmin.php.dist src/Admin/PakketAdmin.php
cp src/Admin/MedewerkerAdmin.php.dist src/Admin/MedewerkerAdmin.php
cp src/Entity/Bedrijf.php.dist src/Entity/Bedrijf.php
cp src/Entity/Contactpersoon.php.dist src/Entity/Contactpersoon.php
cp src/Entity/Medewerker.php.dist src/Entity/Medewerker.php
cp src/Entity/Offertefase.php.dist src/Entity/Offertefase.php
cp src/Entity/Opdrachtfase.php.dist src/Entity/Opdrachtfase.php
cp src/Entity/Pakket.php.dist src/Entity/Pakket.php
cp src/Entity/Taak.php.dist src/Entity/Taak.php
cp src/Entity/Taakfase.php.dist src/Entity/Taakfase.php
cp src/Entity/Taaktype.php.dist src/Entity/Taaktype.php
cp src/Entity/Tag.php.dist src/Entity/Tag.php
cp src/Entity/Timelineentry.php.dist src/Entity/Timelineentry.php
bin/console cache:clear