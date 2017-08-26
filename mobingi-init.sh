#worked with Alm-Agent, for deploying /docs folder to documentation site
sed /etc/apache2/sites-available/000-default.conf -e 's@/var/www/html@/var/www/html/docs@g'
