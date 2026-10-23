# Deployment and verification

These changes are local repository changes. No deployment or existing application database migration has been performed.

## Before rollout

1. Back up the database and uploaded files, record the application release, and verify a restore in a disposable environment.
2. Inspect existing appointments and payments. The new relation migration refuses orphan references and nonnumeric payment appointment IDs instead of deleting or silently converting them. Correct old empty-string relations to NULL only after reviewing the affected rows. Existing data may need cleanup before deployment.
3. Test migrations on a restored MySQL copy. SQLite tests validate fresh migrations and application logic; they do not prove MySQL ALTER statements, legacy data compatibility, or parallel transaction behavior. Run two simultaneous requests for an overlapping slot against MySQL; exactly one must succeed.
4. Configure mail, reCAPTCHA, Square sandbox credentials and webhook settings. Register the exact HTTPS notification URL in Square. SQUARE_WEBHOOK_NOTIFICATION_URL must match exactly, including any trailing slash. The webhook accepts only valid signatures over the raw body and configured URL.
5. Verify existing staff email verification state. Protected client/admin pages now enforce verification. Password reset no longer activates disabled accounts or verifies email. Old custom reset tokens are intentionally invalid; request a new reset link.
6. Resolve dependency audit findings before production release. Compatible npm updates have been applied. Major framework/toolchain migrations must respect the deployed PHP and Node runtime constraints. The audit CI job intentionally reports unresolved findings rather than suppressing them.

Implementation checks passed: 56 tests / 408 assertions on isolated SQLite, the frontend production build, route discovery/cache, and patch whitespace checks. Production npm audit reports zero vulnerabilities. PHP dependency audit still reports 51 advisories across 15 locked packages; the resolver blocks the current Laravel 10 constraint. Full npm audit reports 10 development dependency findings. These are outstanding release work, not waived checks.

## Install and deploy

Use the PHP runtime compatible with composer.json and Composer 2:

```sh
composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader
npm ci
npm run build
php artisan down
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan queue:restart
php artisan up
```

Use a process supervisor for this worker (and restart it after code deployments):

```sh
php artisan queue:work database --tries=3 --timeout=60
```

Set the queue connection retry_after higher than the worker timeout. Newsletter deliveries use the database connection explicitly, isolate recipients, record queued/sent/failed status in newsletter_deliveries, and retry with backoff. Check failed jobs and delivery status rather than treating queued as sent. SMTP is not exactly-once: a worker failure immediately after mail acceptance can cause a duplicate on retry.

The scheduler currently has no new payment-reconciliation task. Keep the existing application scheduler configuration and monitor pending/review payments until each is resolved.

## Payments and booking behavior

- Cart checkout creates an immutable order quote and payment attempt, reprices products from the database, and includes the configured cart tax. Orders and amounts use integer minor units. Tax defaults inherited from the cart package must be checked against the business's intended pricing before release.
- Appointment pricing is the sum of program, session, and consultation fees. The existing shared-calendar, two-hour duration rule is retained in config/booking.php. Dates use the application timezone.
- Guest appointment requests remain pending and display the amount due. They do not collect card payments or claim payment was made. Staff can schedule these requests and arrange payment separately.
- Client card bookings reserve a slot for 15 minutes before payment. Processing or uncertain payments continue blocking the slot until resolved, so an expired hold cannot cause a duplicate booking while a charge is in flight.
- API timeouts and ambiguous provider failures become review cases. Never create another attempt to work around a review case. Look up the provider reference/idempotency key and reconcile against the verified provider result; use Square's signed webhook redelivery where available. No card tokens are stored or logged.
- The session retains an outstanding cart or booking attempt across page refresh. Completed cart payments can be finalized from the status screen. The provider transaction ID and amount/currency/location must match before completion is recorded.
- The legacy client payment history is populated after verified appointment payment. New cart order history is stored in orders/payment_attempts; there is no fulfillment/shipping implementation in this change.
- Canceling an appointment preserves the record and does not issue a refund. Refunds require a separate provider operation and accounting review.
- Program deletion now uses DELETE with CSRF protection. Existing GET delete links no longer work.

## Verification

```sh
vendor/bin/phpunit
npm run build
php artisan route:list --except-vendor
composer audit --locked
npm audit
```

On this Windows installation SQLite is available but disabled in php.ini. Enable it for the test process only:

```powershell
php -d extension=pdo_sqlite vendor/bin/phpunit
```

phpunit.xml forces an in-memory SQLite database and a separate config-cache path. Do not override these settings to point at an application database.

Sandbox checks before release: valid/invalid/expired/replayed reset links; guest/client/admin permissions; declined and successful cards; timeout recovery and duplicate webhook delivery; rescheduling conflicts; mobile/keyboard behavior; order total and tax; and per-recipient queue delivery.

## Monitoring and rollback

Monitor payment_attempts in processing/review, queued/failed newsletter_deliveries, failed_jobs, application error logs, and worker uptime. Never include card tokens or request bodies in logs.

Deploy the previous application release only after checking schema compatibility. Keep the additive order/attempt/history tables when rolling application code back so payment evidence remains available. Restoring a database snapshot after new charges can discard payment history: reconcile those provider transactions before any restore. Practice restoration in a disposable environment and record recovery time before release.
