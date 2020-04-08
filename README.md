# Slim Framework 4 Playground

[![Coverage Status](https://coveralls.io/repos/github/halilsafakkilic/Slim4-Playground/badge.svg?branch=master)](https://coveralls.io/github/halilsafakkilic/Slim4-Playground/?branch=master)

You can use this skeleton application to browse current approaches, best practices and example implementations. This application uses the latest Slim 4 with Slim PSR-7 implementation, some approaches and tools (Dependency Injection (DI), In Memory DB, RDBMS, Single-database CQRS, Domain Driven Design (DDD), Layered Architecture, Repository Pattern, Doctrine ORM (Data Mapper, UnitOfWork Pattern), Unit + Integration Tests, Logging (Monolog based), Debugging (xDebug based)).

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application.

```bash
git clone https://github.com/halilsafakkilic/Slim4-Playground.git [your-app-name]
```

Replace `[your-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `storage/` all sub directories is web writable.

To run the application in development, you can run these commands 

```bash
cd [your-app-name]
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
cd [your-app-name]
docker-compose up -d
```
After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```

If you want to debug please use run this command

```bash
composer debug
```

That's it! Now go build something cool.
