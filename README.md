# The Way We Love

Laravel / Livewire application for counselling content, appointments, resources, events, and website administration.

## Local setup

1. Install the PHP version and extensions required by composer.json and a compatible Node runtime.
2. Install Composer 2, then run `composer install` and `npm ci`.
3. Copy `.env.example` to `.env`, configure a local MySQL database, and run `php artisan key:generate`.
4. On a disposable development database, run `php artisan migrate` and `php artisan storage:link`.
5. Start the app using Laragon or `php artisan serve`; run `npm run dev` for frontend development.
6. Run `php artisan queue:work database --tries=3 --timeout=60` for queued mail. Local mail defaults to the log mailer.

Use Square sandbox credentials for development. Never put access tokens or webhook signature keys into browser templates.

## Checks

```sh
vendor/bin/phpunit
npm run build
php artisan route:list --except-vendor
composer audit --locked
npm audit
```

Tests force an in-memory SQLite database. On the current Windows PHP installation, use `php -d extension=pdo_sqlite vendor/bin/phpunit` to enable the installed SQLite driver for that process.

See [deployment and payment operations](docs/DEPLOYMENT.md) and the [review backlog](IMPROVEMENT_PLAN.md) for rollout requirements, validation limits, and remaining dependency upgrades.
