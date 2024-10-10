web: sed -i 's/{ENV_PORT}/'"${PORT}"'/g; s/{HEROKU_HOME}/'"${HEROKU_APP_DIR}"'/g' nginx_app.conf && heroku-php-nginx -c nginx_app.conf
