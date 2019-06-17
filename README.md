# Gripp client Symfony
Gripp client Symfony

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://raw.githubusercontent.com/noud/gripp_api/master/LICENSE)
[![master](https://img.shields.io/badge/current-dev-aa11ff.svg)](https://github.com/noud/gripp_client_symfony/releases)

This is a Symfony client application that does work with

[Gripp](https://www.gripp.com)s [Gripp API v3](https://github.com/noud/gripp_api)

and demonstrate Gripp API use.

The application is highly independent of the Entities used and a good example of writing generic code.

## Security

The application uses various security measures:
- [Security at GitHub](https://github.com/security)
- [Symfony Security Monitoring](https://security.symfony.com)
- [SQL injection](https://en.wikipedia.org/wiki/SQL_injection) protection
- [Cross-site request forgery (CSRF)](https://en.wikipedia.org/wiki/Cross-site_request_forgery) protection
- [bcrypt](https://en.wikipedia.org/wiki/Bcrypt) password hashing
- [Two-factor authentication (2FA)](https://en.wikipedia.org/wiki/Multi-factor_authentication) using [Google Authenticator](http://code.google.com/p/google-authenticator/)

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

The username demo and password demo will do. (The inactive username nodemo and password nodemo will not be allowed to login.) If you succeed to login, you can navigate to your login credentials in the upper right corner pull-down:

![Credentials](./docs/sonata_credentials.png?raw=true "Credentials")

As you see in the upper right messages and tasks navigation items and tasks pull-down the application uses the [AdminLTE 2](https://adminlte.io/preview) [Bootstrap 3](https://getbootstrap.com/docs/3.4/) template.


## Developing

Feel free to contribute.

### Tools

Created with [Eclipse PDT Extension group Symfony framework plugin](http://p2-dev.pdt-extensions.org)
 ([Eclipse Marketplace](http://marketplace.eclipse.org/content/doctrine-plugin), [site](http://p2-dev.pdt-extensions.org/frameworks.html))   

Eclipse is free open-source project that grows with your contributions.