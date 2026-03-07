# aS.c Boiler Plate

WordPress plugin boilerplate with autoloader, Core, Admin, and Front structure.

**Requires:** PHP 8.1+, WordPress 5.x
**Tested with:** WordPress 6.9.1, PHP 8.3
**Version:** 1.0.0

**Prefixes:** `asc-boiler-plate` (slug, handles, classes), `asc_boiler_plate` (options, JS object names). Use search/replace to rename when starting a new plugin.

---

## Structure

- **asc-boiler-plate.php** – Bootstrap: constant, autoloader, activation/deactivation/uninstall hooks, Core singleton.
- **includes/Core/Core.php** – Lifecycle hooks, plugin URL/path, text domain; loads Admin and Front.
- **includes/Admin/Admin.php** – Settings page (Settings → aS.c Boiler Plate) and admin asset enqueue on that page only.
- **includes/Front/Front.php** – Front-end asset enqueue (front.css, front.js, localized AJAX).
- **assets/admin/** – admin.css, admin.js (jQuery, localized `asc_boiler_plate_admin` with `ajax_url`, `ajax_nonce`).
- **assets/front/** – front.css, front.js (jQuery, localized `asc_boiler_plate_front`).

---

## Setup

1. Copy this folder (or move it) to `wp-content/plugins/asc-boiler-plate/`.
2. Run `composer install` in the plugin directory.
3. Activate the plugin.
4. Go to **Settings → aS.c Boiler Plate** to see the placeholder settings page (admin CSS/JS load there).

---

## Starting a new plugin

1. Copy the boilerplate to a new folder (e.g. `my-plugin`).
2. Search/replace: `asc-boiler-plate` → `my-plugin`, `asc_boiler_plate` → `my_plugin`, `ASC\BoilerPlate` → your namespace, `aS.c Boiler Plate` → your plugin name.
3. Rename the main file to `my-plugin.php` and update the constant and hooks as needed.
