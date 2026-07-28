# PHP Code Explanations

## `includes/bootstrap.php`

`declare(strict_types=1)` enables stricter parameter and return-type checks. The session starts only when one is not already active.

`e()` passes output through `htmlspecialchars` with quote handling and UTF-8, preventing stored values from being interpreted as HTML. `csrf_token()` creates one unpredictable token per session. `verify_csrf()` compares the submitted token with `hash_equals`; invalid requests stop with HTTP 419.

`redirect()` sends a Location response and is declared `never` because it always exits. `require_login()` redirects anonymous visitors and creates a one-use flash message. `flash_message()` reads and immediately removes that message.

## `config/database.php`

Environment variables allow credentials to change without editing source. Defaults match a common local XAMPP installation. PDO connects using `utf8mb4`; exceptions are enabled, associative arrays are the default result format, and emulated prepares are disabled. The catch block hides sensitive connection details while directing the developer to the README.

## `includes/header.php` and `includes/footer.php`

Default page variables allow every page to reuse the templates. The session controls which navigation links appear. Ternary expressions add `active` only to the current page. Every dynamic title and message is passed through `e()`. The footer is static apart from the JavaScript year.

## `index.php`

The file loads session helpers, defines page metadata and includes the header. `$members` is an array of associative arrays containing the exact four names, IDs, image paths and project roles. `foreach` produces one consistent card per member while escaping every value. The footer include completes the page.

## `company.php` and `popups.php`

These pages load the bootstrap, set title/navigation values, include shared templates and output static semantic content. Pop-up behaviour remains in JavaScript, keeping PHP responsible only for server rendering.

## `contact.php`

The POST branch verifies the CSRF token and sets `$formSuccess`. The demonstration intentionally does not email or store visitor data. The view then either shows the form or a success block. In a production system the POST branch would validate fields and use a mail or database service.

## `register.php`

The page loads PDO and sends signed-in users to the dashboard. POST processing trims names, normalizes email case, and validates name length, email format, password length and matching confirmation.

A prepared `SELECT` prevents duplicate accounts. If none exists, a prepared `INSERT` stores `password_hash(...)`, not the original password. A flash message survives the redirect to login. Submitted name and email values are safely returned to the form after validation failure.

## `login.php`

The prepared query finds an account by normalized email. `password_verify()` safely compares the submitted password with its stored hash. Successful authentication regenerates the session ID to prevent fixation, stores only the user ID/name, sets a welcome flash and redirects. Failure uses one generic message so it does not reveal whether an email exists.

## `logout.php`

The session array is emptied. When cookies carry the session ID, the code expires that cookie with its original parameters. It destroys the old server session, starts a clean session only to hold the logout flash, then redirects.

## `dashboard.php`

`require_login()` runs before database access. A `SELECT` retrieves the permitted client columns in newest-first order. `count` gives the total, while `array_filter` counts active clients.

The view casts IDs/counts to integers and escapes every database string. Each delete form contains both record ID and CSRF token. No deletion occurs through a GET link. Status text supplies a lower-case CSS modifier.

## `record-form.php`

The script accepts a validated integer ID from GET or POST. Its presence selects edit mode. Default values support add mode. During editing, a prepared query loads the row; a missing ID produces a flash and redirect.

POST data is copied only for known keys. Server validation checks required lengths, email format and strict membership in the allowed service/status lists. Values are placed in a fixed array, then either a prepared `UPDATE` or `INSERT` runs. PHP’s array spread appends the ID to update parameters. Successful actions use Post/Redirect/Get, preventing duplicate form submissions on refresh.

## `record-delete.php`

Authentication runs first. Any method other than POST receives HTTP 405. The CSRF token and integer ID are validated, and a prepared `DELETE` removes only that ID. `rowCount()` chooses an accurate flash message before redirecting.

## PHP embedded in templates

`<?= ... ?>` is the short form of escaped output when paired with `e()`. `<?php if: ?>`, `foreach` and their matching end statements keep control flow readable inside markup. Integer values use explicit casts instead of HTML escaping because they cannot contain markup.
