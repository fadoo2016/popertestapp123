web: sed -i 's#{ENV_PORT}#'"${PORT}"'#g; s#{HEROKU_HOME}#'"`pwd`"'#g' nginx_app.conf && heroku-php-nginx -c nginx_app.conf
