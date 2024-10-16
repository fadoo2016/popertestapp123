#!/bin/bash
sed -i 's#{ENV_PORT}#'"${PORT}"'#g; s#{HEROKU_HOME}#'"${PWD}"'#g' nginx_app.conf && heroku-php-nginx -c nginx_app.conf
