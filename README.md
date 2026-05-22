# Acolyte REALMS

## Archive Status
This repository is a preserved archive of Acolyte R.E.A.L.M.S. v4.0.2. It reflects a client-era Laravel application that was originally built as a learning platform and later adapted here into a runnable demo for portfolio and archival purposes.

This is not an actively developed product branch. The goal of this repo is to remain understandable, bootable, and demoable with minimal maintenance.

## What This Repo Supports
There are two practical ways to use this archive:

1. Local/dev exploration
   Use the repo to inspect the codebase, boot it locally, and browse the legacy application structure.
2. Public/archive demo
   Use the hardened demo configuration with seeded demo users, constrained behavior, and an optional hourly reset.

For the public demo path, `Database\\Seeders\\DemoSeeder` is the source of truth. The base `DatabaseSeeder` alone is not enough to produce the intended archive demo experience.

## Local / Dev Exploration
Use this path if you want to browse the app locally without treating it as a public-facing demo.

1. Clone the repository.
2. Copy `.env.example` to `.env`.
3. Install frontend dependencies and build assets from the project root:
   `npm install && npm run build`
4. Install PHP dependencies:
   `composer install`
5. Generate the app key:
   `php artisan key:generate`
6. Configure your database connection in `.env`.
7. Seed the base app bootstrap if you only want the non-demo baseline:
   `php artisan migrate --seed`

This mode is mainly for code exploration. It does not produce the intended public demo accounts, demo catalog, demo subscriptions, or demo media set.

## Public / Archive Demo
Use this path if you want the repo to behave like the supported archive demo.

### Minimum Demo Environment
Set these values for the constrained public demo:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://your-demo-host`
- `SESSION_SECURE_COOKIE=true`
- `DEMO_MODE=true`
- `DEMO_ALLOW_WRITES=false`
- `DEMO_ALLOW_BILLING=false`
- `DEMO_ALLOW_MAIL=false`
- `DEMO_ALLOW_UPLOADS=false`
- `DEMO_RESET_ENABLED=true`
- `DEMO_RESET_DISK=digital_ocean`

Use a dedicated demo database and a dedicated resettable storage target. Do not point the demo reset at shared or production-like data.

### Storage Notes
- `FILESYSTEM_DISK`
  Controls the active disk the app uses for demo media such as thumbnails and seeded placeholder assets.
- `DEMO_RESET_DISK`
  Controls which disk `php artisan demo:reset` is allowed to clear before rebuilding the demo database.
- `digital_ocean`
  Is the intended S3-compatible demo disk for this archive. This project uses its own dedicated Spaces bucket, so it is an acceptable reset target.

For this archive's intended public demo setup, point both `FILESYSTEM_DISK` and `DEMO_RESET_DISK` at `digital_ocean` and configure that disk with the `DO_SPACES_*` variables for the project's dedicated bucket.

### Demo Bootstrap
1. Copy `.env.example` to `.env`.
2. Install dependencies:
   `npm install && npm run build`
   `composer install`
3. Generate the app key:
   `php artisan key:generate`
4. Configure:
   - database credentials for a dedicated demo database
   - `DEMO_MODE=true`
   - `FILESYSTEM_DISK=digital_ocean`
   - `DEMO_RESET_DISK=digital_ocean`
   - `DO_SPACES_*` variables for the dedicated demo bucket
   - `DEMO_RESET_WIPE_STRIPE_CUSTOMERS=true` if the dedicated Stripe sandbox should be wiped on every reset
5. Seed the full archive demo:
   `php artisan migrate:fresh --seed --seeder=Database\\Seeders\\DemoSeeder`

### Demo Accounts
The public login page is intended to expose these three accounts:

- `jharper-admin` - Administrator
- `morgan.lee` - Instructor
- `sam.rivera` - User

Shared password:

- `DemoPass123!`

The support account exists in the seed data for internal/admin use, but it is intentionally not part of the public demo credentials list.

## Demo Reset and Scheduler
The archive demo includes `php artisan demo:reset`.

What it does:

- optionally deletes all Stripe customers in the dedicated Stripe sandbox
- clears the configured dedicated demo reset disk
- runs `migrate:fresh --seed --seeder=Database\\Seeders\\DemoSeeder`
- restores the demo to a known baseline

What it refuses to do:

- run when `DEMO_MODE` is disabled
- run when `DEMO_RESET_ENABLED` is disabled
- run when Stripe wipe is enabled but no Stripe secret is configured
- run when Stripe wipe is enabled with a non-test Stripe key unless explicitly allowed
- run against protected non-demo disks such as `local`, `public`, or `s3`
- run against an undefined disk

To enable hourly resets, configure the host or container to run:

```cron
* * * * * cd /path/to/acolyte && php artisan schedule:run >> /dev/null 2>&1
```

The scheduled Laravel task will invoke `demo:reset` hourly when the demo flags are enabled.

## Limitations
The archive demo is intentionally constrained.

- Writes are disabled in demo mode.
- Billing flows are disabled in demo mode.
- Outbound mail actions are disabled in demo mode.
- Upload routes are disabled in demo mode.
- The hourly reset is destructive and will wipe transient demo state.
- Demo media is seeded with placeholder assets where real production assets are not appropriate for the archive.
- This repo still contains a client-era frontend and branding context, so treat screenshots and redistribution carefully.

## Known Archive Quirks
These are acceptable archive-era rough edges and are documented rather than actively redesigned.

- Some legacy views and copy still reflect the original application structure rather than a purpose-built demo shell.
- The repo supports both base seeding and demo seeding, so using the wrong seeder path can produce incomplete behavior.
- The demo relies on seeded placeholder content and seeded subscription records rather than live external service state.
- If `DEMO_RESET_WIPE_STRIPE_CUSTOMERS=true`, each reset deletes all customers in the configured dedicated Stripe sandbox before reseeding.
- The repo still contains both `digital_ocean` and `demo_storage` disk definitions, but this archive's intended demo path uses the dedicated `digital_ocean` bucket.

## Pragmatic Smoke Check
Use this checklist when you want confidence that the archive demo is workable.

1. Install dependencies and build assets.
2. Run:
   `php artisan migrate:fresh --seed --seeder=Database\\Seeders\\DemoSeeder`
3. Confirm the login page shows:
   - `jharper-admin`
   - `morgan.lee`
   - `sam.rivera`
4. Log in as `jharper-admin` and confirm the admin account reaches the normal home experience.
5. Log in as `morgan.lee` and `sam.rivera` and confirm they reach the normal home experience instead of the inactive subscription notice.
6. Confirm blocked features behave as expected in demo mode:
   - billing routes blocked
   - write actions blocked
   - mail routes blocked
   - upload actions blocked
7. Confirm `php artisan demo:reset` only runs when the demo flags are enabled and the reset disk is dedicated to the demo.
8. If hourly reset is desired, confirm the host cron is running `php artisan schedule:run`.

## Environment Example
`.env.example` is the canonical variable inventory. The values below are only an example of the two operating modes, not a universal deployment recipe.

### Base / Local Exploration
```dotenv
APP_ENV=local
APP_DEBUG=true
APP_URL=http://acolyte.test
FILESYSTEM_DISK=local
DEMO_MODE=false
DEMO_RESET_ENABLED=false
```

### Public Archive Demo
```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-demo-host
SESSION_SECURE_COOKIE=true
FILESYSTEM_DISK=digital_ocean
DEMO_MODE=true
DEMO_ALLOW_WRITES=false
DEMO_ALLOW_BILLING=false
DEMO_ALLOW_MAIL=false
DEMO_ALLOW_UPLOADS=false
DEMO_RESET_ENABLED=true
DEMO_RESET_DISK=digital_ocean
DEMO_RESET_SEEDER=Database\\Seeders\\DemoSeeder
DEMO_RESET_WIPE_STRIPE_CUSTOMERS=true
DEMO_RESET_ALLOW_LIVE_STRIPE_KEYS=false
```
