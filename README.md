# AMS2 Combo Generator

## Requirements

Standard requirements for Laravel 11 on PHP 8.3.

## Getting started

To get started with the project, you need three JSON files that can be obtained from the AMS2 Dedicated Server HTTP API:

-   tracks
-   cars

These must be placed in `storage/app/ams2/ams2-data-{cars|tracks}.json`.

Then, you must configure your database via `.env` and then run `php artisan migrate:fresh --seed`. Then the application should be good to go.
