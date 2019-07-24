#!/usr/bin/env sh
rm src/Entity/*.php
bin/console app:mapping:import "App\Entity" annotation-extended --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractNameEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractNameEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter="File" --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractSearchableEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter='(?=^((?!File).)*$)(?=^((?!.*fase).)*$)(?=^((?!.*type).)*$)' --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractNameEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter="fase|type" --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractPhaseEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter='(?=Bedrijf|Contactpersoon|Contractregel|Factuurregel|Inkoopopdrachtregel|Medewerker|Onderdeel|Pakketregel)(?=^((?!Medewerkerdatum).)*$)' --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractExtendedPropertiesEntity"
# @TODO bin/console app:mapping:import "App\Entity" annotation-extended --filter='(?=Bedrijf|Contactpersoon|regel|Medewerker|Onderdeel|^Taak$)(?=^((?!Medewerkerdatum).)*$)' --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractExtendedPropertiesEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter="Grootboek" --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractNameNoExtendedPropertiesEntity"
rm src/Entity/ApiUser.php
rm src/Entity/MigrationVersions.php
bin/console make:entity --regenerate App
rm config/services_sonata.yaml; echo 'services:' > config/services_sonata.yaml
rm src/Admin/VerlofaanvraagAdmin.php; bin/console make:app:admin App/Entity/Verlofaanvraag --id=admin.verlofaanvraag --services=services_sonata.yaml --no-interaction
rm src/Admin/VerlofmutatieAdmin.php; bin/console make:app:admin App/Entity/Verlofmutatie --id=admin.verlofmutatie --services=services_sonata.yaml --no-interaction
rm src/Admin/BedrijfAdmin.php; bin/console make:app:admin App/Entity/Bedrijf --id=admin.bedrijf --services=services_sonata.yaml --no-interaction
rm src/Admin/ContactpersoonAdmin.php; bin/console make:app:admin App/Entity/Contactpersoon --id=admin.contactpersoon --services=services_sonata.yaml --no-interaction
rm src/Admin/ContractAdmin.php; bin/console make:app:admin App/Entity/Contract --id=admin.contract --services=services_sonata.yaml --no-interaction
rm src/Admin/ContractregelAdmin.php; bin/console make:app:admin App/Entity/Contractregel --id=admin.contractregel --services=services_sonata.yaml --no-interaction
rm src/Admin/KostenplaatsAdmin.php; bin/console make:app:admin App/Entity/Kostenplaats --id=admin.kostenplaats --services=services_sonata.yaml --no-interaction
rm src/Admin/MedewerkerAdmin.php; bin/console make:app:admin App/Entity/Medewerker --id=admin.medewerker --services=services_sonata.yaml --no-interaction
rm src/Admin/MedewerkerdatumAdmin.php; bin/console make:app:admin App/Entity/Medewerkerdatum --id=admin.medewerkerdatum --services=services_sonata.yaml --no-interaction
rm src/Admin/FileAdmin.php; bin/console make:app:admin App/Entity/File --id=admin.file --services=services_sonata.yaml --no-interaction
rm src/Admin/MijnurenAdmin.php; bin/console make:app:admin App/Entity/Mijnuren --id=admin.mijnuren --services=services_sonata.yaml --no-interaction
rm src/Admin/FactuurAdmin.php; bin/console make:app:admin App/Entity/Factuur --id=admin.factuur --services=services_sonata.yaml --no-interaction
rm src/Admin/FactuurregelAdmin.php; bin/console make:app:admin App/Entity/Factuurregel --id=admin.factuurregel --services=services_sonata.yaml --no-interaction
rm src/Admin/GrootboekAdmin.php; bin/console make:app:admin App/Entity/Grootboek --id=admin.grootboek --services=services_sonata.yaml --no-interaction
rm src/Admin/AlerttriggerAdmin.php; bin/console make:app:admin App/Entity/Alerttrigger --id=admin.alerttrigger --services=services_sonata.yaml --no-interaction
rm src/Admin/OfferteAdmin.php; bin/console make:app:admin App/Entity/Offerte --id=admin.offerte --services=services_sonata.yaml --no-interaction
rm src/Admin/OffertefaseAdmin.php; bin/console make:app:admin App/Entity/Offertefase --id=admin.offertefase --services=services_sonata.yaml --no-interaction
rm src/Admin/OnderdeelAdmin.php; bin/console make:app:admin App/Entity/Onderdeel --id=admin.onderdeel --services=services_sonata.yaml --no-interaction
rm src/Admin/PakketAdmin.php; bin/console make:app:admin App/Entity/Pakket --id=admin.pakket --services=services_sonata.yaml --no-interaction
rm src/Admin/PakketregelAdmin.php; bin/console make:app:admin App/Entity/Pakketregel --id=admin.pakketregel --services=services_sonata.yaml --no-interaction
rm src/Admin/BetalingAdmin.php; bin/console make:app:admin App/Entity/Betaling --id=admin.betaling --services=services_sonata.yaml --no-interaction
rm src/Admin/TariefuitzonderingAdmin.php; bin/console make:app:admin App/Entity/Tariefuitzondering --id=admin.tariefuitzondering --services=services_sonata.yaml --no-interaction
rm src/Admin/VerkoopproductAdmin.php; bin/console make:app:admin App/Entity/Verkoopproduct --id=admin.verkoopproduct --services=services_sonata.yaml --no-interaction
rm src/Admin/OpdrachtAdmin.php; bin/console make:app:admin App/Entity/Opdracht --id=admin.opdracht --services=services_sonata.yaml --no-interaction
rm src/Admin/OpdrachtfaseAdmin.php; bin/console make:app:admin App/Entity/Opdrachtfase --id=admin.opdrachtfase --services=services_sonata.yaml --no-interaction
rm src/Admin/InkoopfactuurAdmin.php; bin/console make:app:admin App/Entity/Inkoopfactuur --id=admin.inkoopfactuur --services=services_sonata.yaml --no-interaction
rm src/Admin/InkoopfactuurregelAdmin.php; bin/console make:app:admin App/Entity/Inkoopfactuurregel --id=admin.inkoopfactuurregel --services=services_sonata.yaml --no-interaction
rm src/Admin/InkoopopdrachtAdmin.php; bin/console make:app:admin App/Entity/Inkoopopdracht --id=admin.inkoopopdracht --services=services_sonata.yaml --no-interaction
rm src/Admin/InkoopopdrachtregelAdmin.php; bin/console make:app:admin App/Entity/Inkoopopdrachtregel --id=admin.inkoopopdrachtregel --services=services_sonata.yaml --no-interaction
rm src/Admin/InkoopbetalingAdmin.php; bin/console make:app:admin App/Entity/Inkoopbetaling --id=admin.inkoopbetaling --services=services_sonata.yaml --no-interaction
rm src/Admin/TagAdmin.php; bin/console make:app:admin App/Entity/Tag --id=admin.tag --services=services_sonata.yaml --no-interaction
rm src/Admin/TaakAdmin.php; bin/console make:app:admin App/Entity/Taak --id=admin.taak --services=services_sonata.yaml --no-interaction
rm src/Admin/TaakfaseAdmin.php; bin/console make:app:admin App/Entity/Taakfase --id=admin.taakfase --services=services_sonata.yaml --no-interaction
rm src/Admin/TaaktypeAdmin.php; bin/console make:app:admin App/Entity/Taaktype --id=admin.taaktype --services=services_sonata.yaml --no-interaction
rm src/Admin/TimelineentryAdmin.php; bin/console make:app:admin App/Entity/Timelineentry --id=admin.timelineentry --services=services_sonata.yaml --no-interaction
rm src/Admin/ProducteenheidAdmin.php; bin/console make:app:admin App/Entity/Producteenheid --id=admin.producteenheid --services=services_sonata.yaml --no-interaction
rm src/Admin/WebhookAdmin.php; bin/console make:app:admin App/Entity/Webhook --id=admin.webhook --services=services_sonata.yaml --no-interaction
rm src/Admin/ApiUserAdmin.php; bin/console make:sonata:admin --id=api.user --services=services_sonata.yaml --no-interaction App/Entity/Api/ApiUser
bin/edited.sh