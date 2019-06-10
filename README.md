# Gripp client Symfony
Gripp client Symfony

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://raw.githubusercontent.com/noud/gripp_api/master/LICENSE)
[![master](https://img.shields.io/badge/current-dev-aa11ff.svg)](https://github.com/noud/gripp_client_symfony/releases)

This is a Symfony client application that does work with

[Gripp](https://www.gripp.com)s [Gripp API v3](https://github.com/noud/gripp_api)

and demonstrate Gripp API use.

The application is highly independent of the Entities used and a good example of writing generic code.

## Provisioning

Add this local hostname to your DNS.:
```shell
127.0.0.1       gripp.localhost
```
Start Docker. Provision the application with PHP Composer and JavaScript Node.js NPM packages.:
```bash
bin/services.sh
bin/docker_start.sh
bin/provision.sh
```
## Generating

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

The username demo and password demo will do.

## Developing

Feel free to contribute.

### Tools

Created with [Eclipse PDT Extension group Symfony framework plugin](http://p2-dev.pdt-extensions.org)
 ([Eclipse Marketplace](http://marketplace.eclipse.org/content/doctrine-plugin), [site](http://p2-dev.pdt-extensions.org/frameworks.html))   

Eclipse is free open-source project that grows with your contributions.