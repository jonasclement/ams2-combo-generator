# AMS2 Combo Generator

## Requirements

Standard requirements for Laravel 11 on PHP 8.3.

## Getting started

To get started with the project, you need three JSON files that can be obtained from the AMS2 Dedicated Server HTTP API:

-   tracks
-   classes
-   cars

These must be placed in `storage/app/ams2/ams2-data-{cars|classes|tracks}.json`.

Then, you must configure your database via `.env` and run `php artisan migrate`, and then run the importers:

-   `php artisan app:import-tracks`
