# HTML and Page Structure Explanations

PHP templates output the project’s HTML, so this guide explains every distinct HTML block rather than repeating identical shared markup for each page.

## Shared document shell — `includes/header.php`

`<!doctype html>` selects modern HTML. `<html lang="en">` helps assistive technology interpret the language. The `<head>` sets UTF-8 encoding, responsive viewport behaviour, a search description and a per-page title. It loads the single stylesheet and defers the JavaScript file so parsing is not blocked.

The skip link moves keyboard users directly to `<main id="main-content">`. The `<header>` contains a labelled `<nav>`, brand link, mobile menu button and unordered navigation list. `aria-expanded` and `aria-controls` describe the collapsible menu. PHP adds the active class and conditionally shows either authentication links or dashboard/logout links.

## Shared footer — `includes/footer.php`

`</main>` closes the content region opened by the header. The footer uses three semantic groups for branding, quick links and academic context. A span marked `data-current-year` is populated by JavaScript. The closing tags complete the body and document.

## Homepage — `index.php`

The hero `<section>` contains a text column and image-slider `<div>`. Headings establish a clear hierarchy. Links styled as buttons remain links because they navigate. The statistics block uses plain text, while `aria-label` explains the group.

The slider’s `data-*` attributes provide JavaScript hooks without mixing behaviour into HTML. Its image has useful alternative text. Previous and next controls are real buttons with accessible labels. The overlay contains the current count and caption.

The ticker is a labelled section. JavaScript moves only its paragraph; the “Latest” label remains visible. Member profiles are `<article>` elements generated from PHP data. Each has an image, role, heading and ID. The service cards are also articles because each is independently meaningful.

## Company page — `company.php`

The page hero introduces the company. The story section uses two columns: heading context and prose. The values grid contains four numbered articles. The final callout joins a heading and contact link. These regions become single-column automatically on smaller screens.

## Contact page — `contact.php`

The contact grid pairs an `<aside>` containing demonstration details with a form card. Labels wrap their controls, creating explicit accessible names without separate `for` attributes. Appropriate input types activate browser validation and useful mobile keyboards. The hidden CSRF value protects the request. After submission, the form is replaced by a semantic status message.

## Pop-ups page — `popups.php`

Three articles explain `alert`, `confirm` and `prompt`. Each button uses `type="button"` to prevent accidental form submission and a `data-popup` value to identify the requested dialogue. The result region uses `aria-live="polite"` so screen readers announce the outcome.

## Authentication pages — `login.php` and `register.php`

Both pages use a two-panel section: a branded introduction and a focused form. Inputs use `autocomplete` tokens for password-manager support. Registration uses `minlength` as immediate browser guidance; PHP repeats the validation because browser rules can be bypassed. Error containers use `role="alert"`. The hidden CSRF input accompanies every state-changing form.

## Dashboard — `dashboard.php`

The dashboard hero identifies the protected system and exposes the add action. Three articles summarize record counts. The table contains a `<thead>` for column headings and `<tbody>` for retrieved records. Each row displays the database ID, client details, service, status, and actions. Update is a link because it opens an edit page. Delete is a POST form because it changes data. The search input is linked to JavaScript with `data-table-search`. A colspan cell provides a friendly empty state.

## Record form — `record-form.php`

One form supports both add and update modes. In update mode, a hidden ID identifies the row. Text, email, telephone and select controls reflect the database fields. The service and status option lists match the permitted MariaDB enum values. The primary submit label changes by mode, and Cancel returns without changing data.

## SVG image markup — `assets/images/*.svg`

Each SVG begins with a scalable `viewBox`, so it stays sharp at any size. Profile placeholders use rectangles, circles, paths and text to create lightweight illustrated portraits. Each includes a `<title>` connected by `aria-labelledby`. The five slider SVGs use geometric shapes to represent analytics, connection, security, support and growth. They contain no scripts or external dependencies.
