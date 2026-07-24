# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Laravel 5.6 (PHP 7.1/7.4) application for **Vistoria** — a real-estate inspection system ("vistoria imobiliária") for the company Listados. It also bundles adjacent modules used by the same company: key/reservation management ("chaves"/"reserva"), a lease-proposal workflow ("Escolha Azul" / Proposta Pessoa Física + Guarantor/fiador), immobile (property) registration synced from an XML feed, and delivery tracking.

Frontend is server-rendered Blade + AdminLTE, with several standalone Vue 2 widgets mounted into specific pages (survey editor, proposals, team, contacts, file downloads) rather than a single SPA.

## Commands

### PHP / Laravel (run inside the `phpvistoria` container, or locally if you have PHP 7.4 + the extensions from `phpdocker/php-fpm/Dockerfile`)

```bash
docker exec phpvistoria php artisan migrate       # run migrations
docker exec phpvistoria php artisan db:seed       # seed (Users, Ambience, Settings, PF proposal data)
docker exec phpvistoria php artisan migrate:fresh --seed
docker exec phpvistoria php artisan tinker
```

Tests (PHPUnit, config in `phpunit.xml`):
```bash
vendor/bin/phpunit                                # full suite
vendor/bin/phpunit --testsuite Unit
vendor/bin/phpunit --testsuite Feature
vendor/bin/phpunit --filter testMethodName tests/Feature/SomeTest.php   # single test
```
Note: `tests/Unit/ExampleTest.php` and `tests/Feature/ExampleTest.php` are the only tests present (framework defaults) — there is no established test suite for the domain code yet.

### Frontend (Laravel Mix / webpack)

```bash
npm run dev          # development build
npm run watch        # rebuild on change
npm run prod          # production build (minified)
```
Build entry points are defined in `webpack.mix.js`, one per feature area (`app.js`, `survey.js`, `all.js`, `ambience.js`, `teamSite.js`, `proposal_pf.js`, `files.js`, plus vendor copies for pnotify). **Compiled output under `public/js` and `public/css` is committed to the repo** (not gitignored) — after editing anything under `resources/assets/js` or `resources/assets/css`, rerun the relevant `npm run` build and commit the regenerated files in `public/`.

### Docker environment

`docker-compose.yml` defines: `redis`, `mysql` (5.7, container `dbvistoria-vue`, port 50001→3306), `webserver` (nginx, port 5050→80), and `php-fpm` (container `phpvistoria`, built from `phpdocker/php-fpm/Dockerfile`, PHP 7.4). The Dockerfile's `entrypoint.sh` bootstraps a fresh container: copies `.env`, does a clean `npm install && npm run prod`, runs `composer install` twice (a documented workaround for a `PackageManifest.php` bug on the first pass), fixes storage permissions, and generates `APP_KEY` if missing.

## Architecture

### Non-standard app namespace and model location

Despite the Laravel 5.6 defaults, this app does **not** use `App\` or `app/Models/`. Models live directly under `app/` (e.g. `app/Survey.php`, `app/User.php`, `app/Client.php`, `app/Immobile.php`) under the PSR-4 root namespace **`EspindolaAdm\`** (see `composer.json`'s `autoload.psr-4`). `EspindolaAdm\Http\Kernel`, `EspindolaAdm\Providers\AppServiceProvider`, etc. follow the same root namespace.

Watch out: `app/Helpers.php` imports `use AdminEspindola\User;` and `use AdminEspindola\Survey;` — this is a pre-existing typo (should be `EspindolaAdm\...`); those two `use` statements are dead/wrong but happen to not break anything only because the same-namespace `User`/`Survey` classes resolve via `namespace EspindolaAdm;` at the top of the file, not via the (incorrect) `use` import.

### Layered structure per feature

Most features follow: `routes/web.php` (Blade pages, session auth) and `routes/api.php` (JSON endpoints, some public/no-auth, some behind `web`+`auth`) → `app/Http/Controllers/*Controller.php` → optionally `app/Repository/*Repository.php` for query/search logic → Eloquent models in `app/`. Not every controller has a repository; repositories exist mainly for search/listing logic (`SurveyRepository`, `TeamRepository`, `ContactRepository`, `RepositoryAmbience`).

Controllers are large and do most of the request handling directly (e.g. `SurveyController` is ~1100 lines covering CRUD, ordering of ambience photos, PDF export, history, and search) — this is the existing convention, not an anomaly to "fix" incidentally.

Cross-cutting static helpers:
- `EspindolaAdm\FunctionAll` — date formatting (BR→MySQL), Portuguese date/month names, generic file lookups.
- `EspindolaAdm\Helpers` — survey/user helpers, phone registration, currency parsing (`money_real`), XML-sync default values.
Both are plain classes with static methods (not really Eloquent models despite extending `Model`); prefer reusing them over re-implementing date/currency formatting.

### Key domains

- **Survey (`vistoria`)**: the core inspection workflow — `Survey`, `SurveyHistory`, `Ambience`, `OrderAmbienceSurvey`, `FilesAmbience`, `RelSurveyUser`. Has status transitions (e.g. `survey_status == 'Finalizada'`) that gate whether non-admin users can still edit/delete photos (`Helpers::verify_auth_delete_image`). PDF export/print goes through `barryvdh/laravel-dompdf` (`PDF` facade).
- **Immobile**: property records synced from an external XML feed (`ImmobileController@xml`).
- **Chaves/Reserva**: key custody and reservation records (`KeyController`, `ReserveController`), includes a receipt PDF and phone verification for clients.
- **Escolha Azul**: lease proposal flow for individuals (`ProposalPFController`, `GuarantorController`, `Files`/`LeaseGuarantee` models), with its own file upload/download endpoints.
- **Team/Site/Contact**: public-facing site content (team bios with avatar upload, contact form) — `TeamController`, `SiteController`, `ContactController`.

### Auth & middleware

Standard Laravel session auth (`Auth::routes()`), route-level `auth` middleware group gates almost all functional routes. `EspindolaAdm\Http\Kernel` overrides the default global middleware/guest redirect/CSRF/trim-strings classes under the app's own namespace rather than `App\Http\Middleware`.

### Facades/aliases of note (`config/app.php`)

`Datatables` (yajra/laravel-datatables, server-side table data for lists like surveys/proposals), `Form`/`Html` (LaravelCollective, used in older Blade forms), `PDF` (barryvdh/dompdf).

### Localization

App is Portuguese (pt-BR) throughout — model fields, comments, validation messages (`resources/lang/pt-BR`), and most UI strings are in Portuguese. Keep new user-facing strings and DB-facing field names consistent with this convention rather than introducing English.
