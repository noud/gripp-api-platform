#!/usr/bin/env sh
cp src/Admin/BedrijfAdmin.php.dist src/Admin/BedrijfAdmin.php
cp src/Admin/PakketAdmin.php.dist src/Admin/PakketAdmin.php
cp src/Admin/MedewerkerAdmin.php.dist src/Admin/MedewerkerAdmin.php
cp src/Entity/Medewerker.php.dist src/Entity/Medewerker.php
cp src/Entity/Taak.php.dist src/Entity/Taak.php
cp src/Entity/Taakfase.php.dist src/Entity/Taakfase.php
cp src/Entity/Timelineentry.php.dist src/Entity/Timelineentry.php
bin/console cache:clear