# Gripp Symfony

## Architecture

![Architecture](./docs/architecture.png?raw=true "Architecture")

## Use

![Gripp Symfony](./docs/gripp_symfony.png?raw=true "Gripp Symfony")

[![License: MIT](http://img.shields.io/badge/License-MIT-blue.svg)](http://raw.githubusercontent.com/noud/gripp_api/master/LICENSE)
[![master](http://img.shields.io/badge/current-dev-aa11ff.svg)](http://github.com/noud/gripp_symfony/releases)

This is a Symfony client application that does work with

[Gripp](http://www.gripp.com) there [Gripp API v3](http://github.com/noud/gripp_api)

and demonstrate Gripp API use.

The application is highly independent of the Entities used and a good example of writing generic code and [API-First](http://swagger.io/resources/articles/adopting-an-api-first-approach/) development to facilitate a [Rapid-application development (RAD)](http://en.wikipedia.org/wiki/Rapid_application_development) process.

## API front ends

The application consumes the Gripp API as client but has various API server interfaces itself as well:
* [GraphQL](http://en.wikipedia.org/wiki/GraphQL) with it's own [GraphiQL](http://github.com/graphql/graphiql/tree/master/packages/graphiql#readme) in-browser IDE with generated API documentation
    - [Gatsby React](http://github.com/noud/gatsby-graphql-gripp/blob/master/README.md) static [Progressive Web App (PWA)](http://en.wikipedia.org/wiki/Progressive_web_applications), mobile app
* [RESTful](http://en.wikipedia.org/wiki/Representational_state_transfer)
    * [Swagger OpenAPI](http://swagger.io/specification/) with generated API documentation
    * [Hydra](http://www.hydra-cg.com/) and [JSON-LD](http://json-ld.org/)
        - [React Admin](http://github.com/noud/react-admin-rest-openapi-gripp/blob/master/README.md)
        - [React Next Express](http://github.com/noud/react-next-express-hydra-gripp/blob/master/README.md) front end
        - [React Redux](http://github.com/noud/react-redux-rest-openapi-gripp/blob/master/README.md) [Progressive Web App (PWA)](http://en.wikipedia.org/wiki/Progressive_web_applications), mobile app
        - [Vue](http://github.com/noud/gripp_client_vue/blob/master/README.md) [Single-page application (SPA)](http://en.wikipedia.org/wiki/Single-page_application), web application or web site
    * [JSON:API](http://jsonapi.org/)
    * [HAL](http://stateless.co/hal_specification.html)
    * [JSON](http://www.json.org/)
    * [XML](http://www.w3.org/XML/)
    * [YAML](http://yaml.org/)
    * [CSV](http://tools.ietf.org/html/rfc4180)
    * [HTML](http://whatwg.org/)
* [JSON-RPC](http://www.jsonrpc.org/specification)

## export

The web application is able to export it's data to your desktop:
* [CSV](http://en.wikipedia.org/wiki/Comma-separated_values)
* [vCard](http://en.wikipedia.org/wiki/VCard) as an extended(*) Writer
* [JSON](http://en.wikipedia.org/wiki/JSON)
* [Microsoft Excel](http://en.wikipedia.org/wiki/Microsoft_Excel#File_formats)
* [XML](http://en.wikipedia.org/wiki/XML)

*) The extended Writer is part of this project and still [Proof of concept (PoC)](http://en.wikipedia.org/wiki/Proof_of_concept).

## Security

The application uses various security measures:
* [Security at GitHub](http://github.com/security)
* [Symfony Security Monitoring](http://security.symfony.com)
* [Structured Query Language (SQL) injection](http://en.wikipedia.org/wiki/SQL_injection) protection
* [Cross-site request forgery (CSRF)](http://en.wikipedia.org/wiki/Cross-site_request_forgery) protection
* [bcrypt](http://en.wikipedia.org/wiki/Bcrypt) password hashing
* [Two-factor authentication (2FA)](http://en.wikipedia.org/wiki/Multi-factor_authentication) using [Google Authenticator App](http://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2)
* [Bearer Authentication](http://swagger.io/docs/specification/authentication/bearer-authentication) for JSON-RPC API server
* [JWT Authentication](http://jwt.io/) for RESTful API server
* Use [Cross-Origin Resource Sharing (CORS)](http://enable-cors.org) headers for RESTful API server

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
1. JSON to JSON [Table Schema](http://frictionlessdata.io/specs/table-schema) using [PHP](http://php.net)
2. JSON [Table Schema](http://frictionlessdata.io/specs/table-schema) to Database Schema using [tableschema-sql-js](http://github.com/frictionlessdata/tableschema-sql-js)
3. [Generate Models](http://symfony.com/doc/current/doctrine/reverse_engineering.html) with an extended(*) [Doctrine Object Relational Mapper (ORM)](http://www.doctrine-project.org/projects/orm.html) ImportMapping Command
4. [Generate Views](http://symfony.com/doc/master/bundles/SonataAdminBundle/reference/console.html#make-sonata-admin) with an extended(*) [SONATA PROJECT](http://sonata-project.org/)s [AdminMaker Command](http://symfony.com/doc/master/bundles/SonataAdminBundle/reference/console.html#make-sonata-admin) using the [Symfony MakerBundle](http://symfony.com/doc/current/bundles/SymfonyMakerBundle)

*) The extended code generators are part of this project and still [Proof of concept (PoC)](http://en.wikipedia.org/wiki/Proof_of_concept).

The first 2 steps are already done, being outside this project scope. You have to perform the last 2 steps, import the Database Schema and generate Entities and Views, here is how:

Import the database schema and relations.:
```bash
mysql -u root -p db_name< db/schema.sql
mysql -u root -p db_name< db/relations.sql
```
Generate the entities and admin webpages. Migrate and load example data:
```bash
bin/generate.sh
bin/console doctrine:migrations:migrate
mysql -u root -p db_name< db/data.sql
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

As you see in the upper right messages and tasks navigation items and tasks pull-down the application uses the [AdminLTE 2](http://adminlte.io/preview) [Bootstrap 3](http://getbootstrap.com/docs/3.4/) template.

The dashboard contains the [vis.js](http://visjs.org) [Timeline](http://visjs.org/timeline_examples.html), for now only with, entries of the messages and tasks:

![Dashboard](./docs/sonata_dashboard.png?raw=true "Dashboard")

## Developing

Feel free to contribute.

## Contributions made

Using existing code as much as possible, some projects got an accepted Pull Request:
* [AdminLTE Bundle for Symfony 4](http://github.com/kevinpapst/AdminLTEBundle)
      * [Dutch translation added](http://github.com/kevinpapst/AdminLTEBundle/commit/9efc0f388ab908c7187ce7cbfc7d4ef6173e7da5#diff-f1f6a7153c98d120f1ff1ef005ce142e)
* [tableschema-sql-js](http://github.com/frictionlessdata/tableschema-sql-js)
      * [Constraints required, enum added and Field type date, datetime and time added](http://github.com/frictionlessdata/tableschema-sql-js/commit/aff64731771ce095d521373182d4f080fb5f84d2)

## Tools

Created with [Eclipse PDT Extension group Symfony framework plugin](http://p2-dev.pdt-extensions.org)
 ([Eclipse Marketplace](http://marketplace.eclipse.org/content/doctrine-plugin))   
[Eclipse](http://www.eclipse.org/) is free open-source project that grows with your contributions.