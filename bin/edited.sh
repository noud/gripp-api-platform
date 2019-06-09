#!/usr/bin/env sh
cp src/Admin/BetalingAdmin.php.dist src/Admin/BetalingAdmin.php
cp src/Admin/TaaktypeAdmin.php.dist src/Admin/TaaktypeAdmin.php
cp src/Admin/MedewerkerAdmin.php.dist src/Admin/MedewerkerAdmin.php
cp src/Admin/TagAdmin.php.dist src/Admin/TagAdmin.php
cp src/Entity/Medewerker.php.dist src/Entity/Medewerker.php
cp src/Entity/Taaktype.php.dist src/Entity/Taaktype.php
bin/console cache:clear