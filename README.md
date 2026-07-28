# Awesome Group Company Information System

A framework-free PHP and MariaDB website developed as a Web Development group assignment for the MSc Information Technology programme at the University of Cape Coast.

## Group members

| Full name | Student ID |
|---|---|
| Ebenezer Nana Annan | MS/ITE/25/0041 |
| Okyere-Darko Addai | MS/ITE/25/0044 |
| Frank Akrasi Antwi | MS/ITE/25/0051 |
| Michael Essel | MS/ITE/25/0053 |

## Assignment features

- `index.php` homepage with four member profile cards and student IDs.
- Responsive navigation, company information and contact pages.
- JavaScript `alert()`, `confirm()` and `prompt()` demonstrations.
- JavaScript scrolling announcement text.
- JavaScript image swap using exactly five homepage illustrations.
- Account registration, login and logout.
- Protected client information dashboard.
- MariaDB create, retrieve, update and delete operations.
- Searchable HTML table for retrieved database records.
- Responsive layout using both Flexbox and CSS Grid.
- Secure password hashing, prepared statements, output escaping and CSRF tokens.

## Requirements

- PHP 8.1 or later with the `pdo_mysql` extension.
- MariaDB 10.4 or later (MySQL 8 also works).
- Apache, Nginx, or PHP’s development server.
- A modern browser.

XAMPP is the simplest option on Windows because it includes Apache, PHP and MariaDB.

## Setup with XAMPP

1. Install XAMPP and start **Apache** and **MySQL** from its control panel.
2. Copy the whole project folder into `C:\xampp\htdocs\AwesomeGroup8`.
3. Open `http://localhost/phpmyadmin`.
4. Select **Import**, choose `database/schema.sql`, then run the import. It creates the `awesome_group` database, both tables and three demonstration records.
5. The default database settings are:

   ```text
   host: 127.0.0.1
   port: 3306
   database: awesome_group
   username: root
   password: (empty)
   ```

6. Visit `http://localhost/AwesomeGroup8/`.
7. Choose **Register**, create an account, log in, and open **Records** to test all CRUD actions.

## Setup with PHP’s development server

Import the database first, open PowerShell in the project folder, then run:

```powershell
php -S localhost:8000
```

Visit `http://localhost:8000`. MariaDB must still be running.

## Custom database credentials

`config/database.php` reads environment variables before falling back to the XAMPP defaults. Set them before starting the server when your database differs:

```powershell
$env:DB_HOST = "127.0.0.1"
$env:DB_PORT = "3306"
$env:DB_NAME = "awesome_group"
$env:DB_USER = "your_username"
$env:DB_PASS = "your_password"
php -S localhost:8000
```

## Using the system

- **Add:** select **+ Add record**, complete the form and submit.
- **Retrieve:** open **Records** after login. All records are selected and displayed in the table.
- **Update:** select **Update** beside a row, edit it and submit.
- **Delete:** select **Delete** and accept the JavaScript confirmation.
- **Filter:** type in the Search field above the records table.

## Project structure

```text
assets/
  css/styles.css          Shared visual design and responsive layouts
  images/                 Four profile placeholders and five slider SVGs
  js/main.js              Navigation, ticker, slider, pop-ups and table behaviour
config/database.php       PDO database connection
database/schema.sql       Database, tables and sample records
includes/                 Shared bootstrap, header and footer
index.php                 Homepage
company.php               Company information
contact.php               Contact form demonstration
popups.php                Three JavaScript pop-up demonstrations
register.php              User registration
login.php                 Authentication
logout.php                Session logout
dashboard.php             Protected retrieve/table view
record-form.php           Add and update form
record-delete.php         Protected delete action
explanations_*.md         Language-by-language code explanations
```

## Profile pictures

The supplied SVG portraits are intentionally labelled placeholders because no personal photographs were provided. To use real photographs, place four appropriately licensed images in `assets/images/` and change the four `image` values in the `$members` array in `index.php`. Keep the images close to a 4:5 portrait ratio.

## Security and academic scope

Passwords are stored with PHP’s password hashing API, never as plain text. Database operations use prepared statements, forms use CSRF protection and output is HTML-escaped. The contact form demonstrates form handling but intentionally does not send email or store messages. For a public production deployment, add HTTPS, secure session-cookie settings, rate limiting, email verification, database backups, audit logging and server-side contact-message processing.

## Code explanations

- [HTML and page structure](explanations_html.md)
- [PHP and database behaviour](explanations_php.md)
- [JavaScript interactions](explanations_js.md)
- [CSS, Flexbox and Grid](explanations_css.md)

## Troubleshooting

- **Database connection failed:** confirm MariaDB is running, import `database/schema.sql`, and verify the credentials.
- **`could not find driver`:** enable `extension=pdo_mysql` in `php.ini`, then restart the server.
- **Styles are missing:** serve the project from its root; do not open PHP files directly from the filesystem.
- **Headers already sent:** ensure no whitespace is added before `<?php` in PHP-only files.
- **Image placeholders appear instead of photographs:** this is expected until the group replaces the supplied SVG files.

## Licence

Created for academic demonstration. Google Fonts are requested by the stylesheet; the site falls back to system sans-serif fonts if the network is unavailable.
