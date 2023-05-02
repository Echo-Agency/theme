Instalacja:
Czysta DB
JPA + kickstart
wp-content/themes/understrap npm install (node <= 11.9)
wp-content/themes/understrap-child npm install (node <= 11.9)

update:
git pull origin main

coding standard:
phpcs --standard=WordPress --extensions=php --ignore=*/node_modules/* .
phpcs -s --report-summary --standard=WordPress --extensions=php --ignore=*/node_modules/* .

phpcbf --standard=WordPress --extensions=php --ignore=*/node_modules/* .


DEPLOY PROD
turn on W3 Total Cache

php wp-cli.phar media regenerate --image_size=medium_cropped

all
php wp-cli.phar media regenerate --yes