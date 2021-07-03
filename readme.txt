/admin - admin panel, allow to edit templates in /templates
/assets - public assets (scss, images, libs)
/templates - for TWIG templates
/var - for cache and logs
/index.php - main script (for compile scss and call to TWIG renderer)
/process.call.php - form processor (you can call it via ajax or as you like, it is just a php file)
/settings.php - contains login and password for admin panel

=======

Usage:

Unpack to document root and run "composer update"

Next you can develope you landing page: set up nessesary images, fonts, libs in /assets, edit templates, styles.scss (scss files compile with css map on demand), scripts.js