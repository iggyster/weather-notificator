# Weather notificator

A console application which is capable to examine whether data and depending on the temperature send notifications.

It uses [Open Weather Map API](https://openweathermap.org/api) to fetch weather data & 
[Routee API](https://docs.routee.net/docs/) to send SMS-notifications.

## Requirements

* Git
* Docker
* Straight arms :)

## Necessary deploy steps

* At first clone the repo (if you have some access issue talk to the author)
* Execute `cp .env.dist .env` (if `.env` not defined)
* Fill `.env` with credentials (if `.env` not defined)
* In the main root folder run: `docker-compose up -d`
* Install all packages: `docker-compose exec php composer install`
* Run cron by executing: `docker-compose exec php service cron start`

**! TO STOP CRON RUN** `docker-compose exec php service cron stop`
