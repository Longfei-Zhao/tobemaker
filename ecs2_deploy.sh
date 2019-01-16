rm -rf /var/www/tobemaker/*
cp -rf * /var/www/tobemaker/
cp /var/www/tobemaker/config.ecs2.php /var/www/tobemaker/config.php
cp .htaccess /var/www/tobemaker/.htaccess
chmod -R 777 /var/www/tobemaker/tmp
chmod -R 777 /var/www/tobemaker/upload
