#!/usr/bin/env sh
rm src/Entity/*.php
bin/console app:mapping:import "App\Entity" annotation-extended --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractNameEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractNameEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter="File" --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractSearchableEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter='(?=^((?!File).)*$)(?=^((?!.*phase).)*$)(?=^((?!.*type).)*$)' --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractNameEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter="phase|type" --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractPhaseEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter='(?=Company|Contact|Employee$|.*line$|^Task$|Timelineentry|Purchasepayment|Purchaseinvoice|Payment|Invoice|Hour|Absencerequest$)(?=^((?!Employeefamily).)*$)' --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractExtendedPropertiesEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter="Ledger" --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractNameNoExtendedPropertiesEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter='Webhook|Priceexception' --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractExtendedPropertiesNoSearchableEntity"
bin/console app:mapping:import "App\Entity" annotation-extended --filter='Notification' --path=src/Entity --class_to_extend="App\Entity\AbstractEntity\AbstractEntity"
rm src/Entity/ApiUser.php
rm src/Entity/MigrationVersions.php
bin/console make:entity --regenerate App
rm config/services_sonata.yaml; echo 'services:' > config/services_sonata.yaml
rm src/Admin/AbsencerequestAdmin.php; bin/console make:app:admin App/Entity/Absencerequest --id=admin.absencerequest --services=services_sonata.yaml --no-interaction
rm src/Admin/AbsencerequestlineAdmin.php; bin/console make:app:admin App/Entity/Absencerequestline --id=admin.absencerequestline --services=services_sonata.yaml --no-interaction
rm src/Admin/CompanyAdmin.php; bin/console make:app:admin App/Entity/Company --id=admin.company --services=services_sonata.yaml --no-interaction
rm src/Admin/ContactAdmin.php; bin/console make:app:admin App/Entity/Contact --id=admin.contact --services=services_sonata.yaml --no-interaction
rm src/Admin/ContractAdmin.php; bin/console make:app:admin App/Entity/Contract --id=admin.contract --services=services_sonata.yaml --no-interaction
rm src/Admin/ContractlineAdmin.php; bin/console make:app:admin App/Entity/Contractline --id=admin.contractline --services=services_sonata.yaml --no-interaction
rm src/Admin/CostheadingAdmin.php; bin/console make:app:admin App/Entity/Costheading --id=admin.costheading --services=services_sonata.yaml --no-interaction
rm src/Admin/EmployeeAdmin.php; bin/console make:app:admin App/Entity/Employee --id=admin.employee --services=services_sonata.yaml --no-interaction
rm src/Admin/EmployeefamilyAdmin.php; bin/console make:app:admin App/Entity/Employeefamily --id=admin.employeefamily --services=services_sonata.yaml --no-interaction
rm src/Admin/FileAdmin.php; bin/console make:app:admin App/Entity/File --id=admin.file --services=services_sonata.yaml --no-interaction
rm src/Admin/HourAdmin.php; bin/console make:app:admin App/Entity/Hour --id=admin.hour --services=services_sonata.yaml --no-interaction
rm src/Admin/InvoiceAdmin.php; bin/console make:app:admin App/Entity/Invoice --id=admin.invoice --services=services_sonata.yaml --no-interaction
rm src/Admin/InvoicelineAdmin.php; bin/console make:app:admin App/Entity/Invoiceline --id=admin.invoiceline --services=services_sonata.yaml --no-interaction
rm src/Admin/LedgerAdmin.php; bin/console make:app:admin App/Entity/Ledger --id=admin.ledger --services=services_sonata.yaml --no-interaction
rm src/Admin/NotificationAdmin.php; bin/console make:app:admin App/Entity/Notification --id=admin.notification --services=services_sonata.yaml --no-interaction
rm src/Admin/OfferAdmin.php; bin/console make:app:admin App/Entity/Offer --id=admin.offer --services=services_sonata.yaml --no-interaction
rm src/Admin/OfferphaseAdmin.php; bin/console make:app:admin App/Entity/Offerphase --id=admin.offerphase --services=services_sonata.yaml --no-interaction
rm src/Admin/OfferprojectlineAdmin.php; bin/console make:app:admin App/Entity/Offerprojectline --id=admin.offerprojectline --services=services_sonata.yaml --no-interaction
rm src/Admin/PacketAdmin.php; bin/console make:app:admin App/Entity/Packet --id=admin.packet --services=services_sonata.yaml --no-interaction
rm src/Admin/PacketlineAdmin.php; bin/console make:app:admin App/Entity/Packetline --id=admin.packetline --services=services_sonata.yaml --no-interaction
rm src/Admin/PaymentAdmin.php; bin/console make:app:admin App/Entity/Payment --id=admin.payment --services=services_sonata.yaml --no-interaction
rm src/Admin/PriceexceptionAdmin.php; bin/console make:app:admin App/Entity/Priceexception --id=admin.priceexception --services=services_sonata.yaml --no-interaction
rm src/Admin/ProductAdmin.php; bin/console make:app:admin App/Entity/Product --id=admin.product --services=services_sonata.yaml --no-interaction
rm src/Admin/ProjectAdmin.php; bin/console make:app:admin App/Entity/Project --id=admin.project --services=services_sonata.yaml --no-interaction
rm src/Admin/ProjectphaseAdmin.php; bin/console make:app:admin App/Entity/Projectphase --id=admin.projectphase --services=services_sonata.yaml --no-interaction
rm src/Admin/PurchaseinvoiceAdmin.php; bin/console make:app:admin App/Entity/Purchaseinvoice --id=admin.purchaseinvoice --services=services_sonata.yaml --no-interaction
rm src/Admin/PurchaseinvoicelineAdmin.php; bin/console make:app:admin App/Entity/Purchaseinvoiceline --id=admin.purchaseinvoiceline --services=services_sonata.yaml --no-interaction
rm src/Admin/PurchaseorderAdmin.php; bin/console make:app:admin App/Entity/Purchaseorder --id=admin.purchaseorder --services=services_sonata.yaml --no-interaction
rm src/Admin/PurchaseorderlineAdmin.php; bin/console make:app:admin App/Entity/Purchaseorderline --id=admin.purchaseorderline --services=services_sonata.yaml --no-interaction
rm src/Admin/PurchasepaymentAdmin.php; bin/console make:app:admin App/Entity/Purchasepayment --id=admin.purchasepayment --services=services_sonata.yaml --no-interaction
rm src/Admin/TagAdmin.php; bin/console make:app:admin App/Entity/Tag --id=admin.tag --services=services_sonata.yaml --no-interaction
rm src/Admin/TaskAdmin.php; bin/console make:app:admin App/Entity/Task --id=admin.task --services=services_sonata.yaml --no-interaction
rm src/Admin/TaskphaseAdmin.php; bin/console make:app:admin App/Entity/Taskphase --id=admin.taskphase --services=services_sonata.yaml --no-interaction
rm src/Admin/TasktypeAdmin.php; bin/console make:app:admin App/Entity/Tasktype --id=admin.tasktype --services=services_sonata.yaml --no-interaction
rm src/Admin/TimelineentryAdmin.php; bin/console make:app:admin App/Entity/Timelineentry --id=admin.timelineentry --services=services_sonata.yaml --no-interaction
rm src/Admin/UnitAdmin.php; bin/console make:app:admin App/Entity/Unit --id=admin.unit --services=services_sonata.yaml --no-interaction
rm src/Admin/WebhookAdmin.php; bin/console make:app:admin App/Entity/Webhook --id=admin.webhook --services=services_sonata.yaml --no-interaction
rm src/Admin/ApiUserAdmin.php; bin/console make:sonata:admin --id=api.user --services=services_sonata.yaml --no-interaction App/Entity/Api/ApiUser
patch bin/services_sonata.yaml.diff
bin/edited.sh