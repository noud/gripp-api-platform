# Gripp client Symfony

![Gripp client Symfony](./docs/gripp_client_symfony.png?raw=true "Gripp client Symfony")

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://raw.githubusercontent.com/noud/gripp_api/master/LICENSE)
[![master](https://img.shields.io/badge/current-dev-aa11ff.svg)](https://github.com/noud/gripp_client_symfony/releases)

This is a Symfony client application that does work with

[Gripp](https://www.gripp.com) there [Gripp API v3](https://github.com/noud/gripp_api)

and demonstrate Gripp API use.

The application is highly independent of the Entities used and a good example of writing generic code to facilitate a [Rapid-application development (RAD)](https://en.wikipedia.org/wiki/Rapid_application_development) development process.

## API

The application consumes the Gripp API as client but has various API server interfaces itself as well:
 - [JSON-RPC](https://www.jsonrpc.org/specification)
 - [RESTful](https://en.wikipedia.org/wiki/Representational_state_transfer) todo
 - [GraphQL](https://en.wikipedia.org/wiki/GraphQL) todo

## export

The application is able to export it's data to your desktop:
 - [CSV](https://en.wikipedia.org/wiki/Comma-separated_values)
 - [vCard](https://en.wikipedia.org/wiki/VCard) as an extended(*) Writer
 - [JSON](https://en.wikipedia.org/wiki/JSON)
 - [Microsoft Excel](https://en.wikipedia.org/wiki/Microsoft_Excel#File_formats)
 - [XML](https://en.wikipedia.org/wiki/XML)

*) The extended Writer is part of this project and still [Proof of concept (PoC)](https://en.wikipedia.org/wiki/Proof_of_concept).

## Security

The application uses various security measures:
- [Security at GitHub](https://github.com/security)
- [Symfony Security Monitoring](https://security.symfony.com)
- [Structured Query Language (SQL) injection](https://en.wikipedia.org/wiki/SQL_injection) protection
- [Cross-site request forgery (CSRF)](https://en.wikipedia.org/wiki/Cross-site_request_forgery) protection
- [bcrypt](https://en.wikipedia.org/wiki/Bcrypt) password hashing
- [Two-factor authentication (2FA)](https://en.wikipedia.org/wiki/Multi-factor_authentication) using [Google Authenticator App](https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2)
- [Bearer Authentication](https://swagger.io/docs/specification/authentication/bearer-authentication) for JSON-RPC API server

## Provisioning

Add this local hostname to your DNS.:
```shell
127.0.0.1       gripp.localhost
```
Start Docker. Provision the application with PHP Composer and JavaScript Node.js NPM packages.:
```bash
bin/docker_start.sh
bin/provision.sh
```
## Generating

We generate large part of the application:
- JSON to JSON [Table Schema](https://frictionlessdata.io/specs/table-schema) using [PHP](https://php.net)
- JSON [Table Schema](https://frictionlessdata.io/specs/table-schema) to Database Schema using [tableschema-sql-js](https://github.com/frictionlessdata/tableschema-sql-js)
- [Generate Models](https://symfony.com/doc/current/doctrine/reverse_engineering.html) with an extended(*) [Doctrine Object Relational Mapper (ORM)](https://www.doctrine-project.org/projects/orm.html) ImportMapping Command
- [Generate Views](https://symfony.com/doc/master/bundles/SonataAdminBundle/reference/console.html#make-sonata-admin) with an extended(*) [SONATA PROJECT](https://sonata-project.org/)s [AdminMaker Command](https://symfony.com/doc/master/bundles/SonataAdminBundle/reference/console.html#make-sonata-admin) using the [Symfony MakerBundle](https://symfony.com/doc/current/bundles/SymfonyMakerBundle)

*) The extended code generators are part of this project and still [Proof of concept (PoC)](https://en.wikipedia.org/wiki/Proof_of_concept).

The first 2 steps are already done, being outside this project scope. You have to perform the last 2 steps, import the Database Schema and generate Entities and Views, here is how:

Import the database schema and optionally some demo data.:
```bash
mysql -u root -p db_name< db/schema.sql
mysql -u root -p db_name< db/data.sql
```
Generate the entities and admin webpages.:
```bash
bin/generate.sh
```
## Tests

First start and go into your Docker workspace:
```bash
bin/docker_workspace.sh
```
In there run:
```bash
bin/phpunit
```

## Usage

Browse to the login screen:
```bash
/opt/google/chrome/chrome http://gripp.localhost/sonata
```
You will be prompted for your credentials:

![Login](./docs/sonata_login.png?raw=true "Login")

The username demo and password demo will do. (The inactive username nodemo and password nodemo will not be allowed to login.) If you succeed to login, you can navigate to your login credentials in the upper right corner pull-down:

![Credentials](./docs/sonata_credentials.png?raw=true "Credentials")

As you see in the upper right messages and tasks navigation items and tasks pull-down the application uses the [AdminLTE 2](https://adminlte.io/preview) [Bootstrap 3](https://getbootstrap.com/docs/3.4/) template.

The dashboard contains the [vis.js](https://visjs.org) [Timeline](https://visjs.org/timeline_examples.html), for now only with, entries of the messages and tasks:

![Dashboard](./docs/sonata_dashboard.png?raw=true "Dashboard")

## Developing

Feel free to contribute.

## Contributions made

Using existing code as much as possible, some projects got an accepted Pull Request:
- [AdminLTE Bundle for Symfony 4](https://github.com/kevinpapst/AdminLTEBundle)
	- [Dutch translation added](https://github.com/kevinpapst/AdminLTEBundle/commit/9efc0f388ab908c7187ce7cbfc7d4ef6173e7da5#diff-f1f6a7153c98d120f1ff1ef005ce142e)
- [tableschema-sql-js](https://github.com/frictionlessdata/tableschema-sql-js)
	- [Constraints required, enum added and Field type date, datetime and time added](https://github.com/frictionlessdata/tableschema-sql-js/commit/aff64731771ce095d521373182d4f080fb5f84d2)

### Tools

Created with [Eclipse PDT Extension group Symfony framework plugin](http://p2-dev.pdt-extensions.org)
 ([Eclipse Marketplace](http://marketplace.eclipse.org/content/doctrine-plugin), [site](http://p2-dev.pdt-extensions.org/frameworks.html))   

Eclipse is free open-source project that grows with your contributions.