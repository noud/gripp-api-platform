#!/usr/bin/env sh
cp src/Admin/CompanyAdmin.php.dist src/Admin/CompanyAdmin.php
cp src/Admin/ContactAdmin.php.dist src/Admin/ContactAdmin.php
cp src/Admin/PacketAdmin.php.dist src/Admin/PacketAdmin.php
cp src/Admin/EmployeeAdmin.php.dist src/Admin/EmployeeAdmin.php
cp src/Entity/Company.php.dist src/Entity/Company.php
cp src/Entity/Contact.php.dist src/Entity/Contact.php
cp src/Entity/Employee.php.dist src/Entity/Employee.php
cp src/Entity/Packet.php.dist src/Entity/Packet.php
cp src/Entity/Taskphase.php.dist src/Entity/Taskphase.php
cp src/Entity/Task.php.dist src/Entity/Task.php
cp src/Entity/Tasktype.php.dist src/Entity/Tasktype.php
cp src/Entity/Timelineentry.php.dist src/Entity/Timelineentry.php
bin/console cache:clear