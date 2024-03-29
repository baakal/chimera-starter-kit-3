# Census (CSPro) dashboard starter kit

[![Latest Version on Packagist](https://img.shields.io/packagist/v/uneca/census-dashboard-starter-kit.svg?style=flat-square)](https://packagist.org/packages/uneca/census-dashboard-starter-kit)
[![Total Downloads](https://img.shields.io/packagist/dt/uneca/census-dashboard-starter-kit.svg?style=flat-square)](https://packagist.org/packages/uneca/census-dashboard-starter-kit)

Census dashboard starter kit is a census/survey dashboard application scaffolding built for the popular PHP Laravel framework. It provides the perfect starting point for your dashboard and includes various features.

It is built on top of Laravel Jetstream starter kit.

## Installation

Once you have created a fresh Laravel project, you can install the package via composer:

```bash
composer require uneca/census-dashboard-starter-kit
```

Then install the kit using:

```bash
php artisan chimera:install
```

Then edit your .env file so as to add your postgres database (you also need to add the postgis extension to it) details etc.

Then run the migrations

```bash
php artisan migrate
```

After installing the kit, you should install and build your NPM dependencies:
```bash
npm install
npm run dev
```

Finally you can run the adminify command to create a super admin user with which you can access your new dashboard
```bash
php artisan adminify
```
## Docker
The starter kit provides a Docker environment for your dashboard. Other than Docker, no software or libraries are required to be installed on your machine.After chimera package has been installed, you may run the chimera:dockerize Artisan command. This command will publish docker-compose.yml and runtime config files to the root of your application:

```bash
php artisan chimera:dockerize
```
To Build the dashboard container image use:

```bash
docker-compose build
```

Finally, you may start docker containers using:

```bash
docker-compose up
```


you can run the migrate command using this cmd
```bash
docker-compose exec chimera.web php artisan migrate
```
you can run the adminify command to create a super admin user with which you can access your new dashboard

```bash
docker-compose exec chimera.web php artisan migrate
```

## Usage

### Concept Overview
Using this dashboard starter kit is rather straightforward. Once installed, it comes with all the necessary features built-in. 
Your task will be to create indicators that populate the dashboard.

You accomplish this by first adding your "questionnaire" to the dashboard. This basically involves entering your data source (CSPro breakout database?) connection
details and other relevant information such as the exercise start and end dates.

Next you use the built-in 'chimera:make-indicator' command to generate your indicator skeleton file (with sample code, if you choose so). At a minimum, you have to 
fill out two basic methods with code that is specific to your questionnaire/database and the type of chart you have chosen for your indicator. Your indicator will then be ready for use.

Then create 'pages' and assign your indicators to those pages as per the classification logic you deem appropriate.

You also need to import your administrative areas so that the area filter can function properly.
Each of the above steps are explained in detail below.

### Questionnaires
Questionnaire is a foundational concept in the dashboard. It is the entity that represents your census/survey exercise. Your dashboard can have 
and display multiple questionnaires at the same time with each one connecting to its own MySQL database.

Before creating indicators, you need to add the questionnaire it belongs to. To do so, go to the 'Manage' menu, then 'Questionnaires'. There you can use the 'Create new' button to launch the questionnaire creation form.

Have details such as the exercise start and end dates on the ready. You will also need to enter your database connection details such as database host, name, username and password.

You can add multiple questionnaires to your dashboard each with its own database connection.

### Importing administrative areas
Indicators on a page are meant to show data at various area levels (such as region, district, SA, EA...). To be able to control that, each page has an area selector
on top which you can select smaller and smaller areas from.

Before you can have the area selector functional, you first need to import all your areas into the system from either an Excel or CSV file.

The file needs to be structured in a particular way where by it has columns for all your area names and area codes.

Please see the following example file.

SCREENSHOT HERE

To import your areas from the file, run the chimera:import-areas command

```bash
php artisan chimera:import-areas /home/census/Desktop/enum_areas.csv
```

You will then be led through an interactive process of identifying and importing the areas in the different columns along with their parent-child relationship.

The following are available flags you can use when running the command

--truncate : Whether the table should be truncated before importing the areas

--zero-pad-codes : Whether to zero pad codes, padding length will be requested for each code column

--connection= : You can provide a connection name if you have different areas per connection


### Indicators
Creating an indicator is usually done during the design/development of the dashboard...
```bash
php artisan chimera:make-indicator --
```

The following are available flags you can use when running the command

--include-sample-code : Whether the generated stub should include functioning sample code

### Pages
Dashboard managers can organize indicators under various pages...



## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [UNECA](https://github.com/tech-acs)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
