PHPDocker.io generated environment
==================================

# Add to your project #

Simply, unzip the file into your project, this will create `docker-compose.yml` on the root of your project and a folder named `phpdocker` containing nginx and php-fpm config for it.

Ensure the webserver config on `phpdocker/nginx/nginx.conf` is correct for your project. PHPDocker.io will have customised this file according to the application type you chose on the generator, for instance `web/app|app_dev.php` on a Symfony project, or `public/index.php` on generic apps.

Note: you may place the files elsewhere in your project. Make sure you modify the locations for the php-fpm dockerfile, the php.ini overrides and nginx config on `docker-compose.yml` if you do so.
 
# How to run #

Dependencies:

  * Docker engine v1.13 or higher. Your OS provided package might be a little old, if you encounter problems, do upgrade. See [https://docs.docker.com/engine/installation](https://docs.docker.com/engine/installation)
  * Docker compose v1.12 or higher. See [docs.docker.com/compose/install](https://docs.docker.com/compose/install/)

Once you're done, simply `cd` to your project and run `docker-compose up -d`. This will initialise and start all the containers, then leave them running in the background.

## Services exposed outside your environment ##

You can access your application via **`localhost`**. Mailhog and nginx both respond to any hostname, in case you want to add your own hostname on your `/etc/hosts`

Service|Address outside containers
------|---------|-----------
Webserver|[localhost:50000](http://localhost:50000)
MySQL|**host:** `localhost`; **port:** `50002`

## Hosts within your environment ##

You'll need to configure your application to use any services you enabled:

Service|Hostname|Port number
------|---------|-----------
php-fpm|php-fpm|9000
MySQL|mysql|3306 (default)
Redis|redis|6379 (default)

# Docker compose cheatsheet #

**Note:** you need to cd first to where your docker-compose.yml file lives.

  * Start containers in the background: `docker-compose up -d`
  * Start containers on the foreground: `docker-compose up`. You will see a stream of logs for every container running.
  * Stop containers: `docker-compose stop`
  * Kill containers: `docker-compose kill`
  * View container logs: `docker-compose logs`
  * Execute command inside of container: `docker-compose exec SERVICE_NAME COMMAND` where `COMMAND` is whatever you want to run. Examples:
        * Shell into the PHP container, `docker-compose exec php-fpm bash`
        * Run symfony console, `docker-compose exec php-fpm bin/console`
        * Open a mysql shell, `docker-compose exec mysql mysql -uroot -pCHOSEN_ROOT_PASSWORD`

# Application file permissions #

As in all server environments, your application needs the correct file permissions to work properly. You can change the files throughout the container, so you won't care if the user exists or has the same ID on your host.

`docker-compose exec php-fpm chown -R www-data:www-data /application/public`

# Recommendations #

It's hard to avoid file permission issues when fiddling about with containers due to the fact that, from your OS point of view, any files created within the container are owned by the process that runs the docker engine (this is usually root). Different OS will also have different problems, for instance you can run stuff in containers using `docker exec -it -u $(id -u):$(id -g) CONTAINER_NAME COMMAND` to force your current user ID into the process, but this will only work if your host OS is Linux, not mac. Follow a couple of simple rules and save yourself a world of hurt.

  * Run composer outside of the php container, as doing so would install all your dependencies owned by `root` within your vendor folder.
  * Run commands (ie Symfony's console, or Laravel's artisan) straight inside of your container. You can easily open a shell as described above and do your thing from there.

# Simple basic Xdebug configuration with integration to PHPStorm

## Xdebug 2
To configure **Xdebug 2** you need add these lines in php-fpm/php-ini-overrides.ini:

### For linux:
```
xdebug.remote_enable = 1
xdebug.remote_connect_back = 1
xdebug.remote_autostart = 1
```

### For macOS and Windows:
```
xdebug.remote_enable = 1
xdebug.remote_host = host.docker.internal
xdebug.remote_autostart = 1
```
## Xdebug 3
To configure **Xdebug 3** you need add these lines in php-fpm/php-ini-overrides.ini:

### For linux:
```
xdebug.mode = debug
xdebug.remote_connect_back = true
xdebug.start_with_request = yes
```

### For macOS and Windows:
```
xdebug.mode = debug
xdebug.remote_host = host.docker.internal
xdebug.start_with_request = yes
```

## Add the section “environment” to the php-fpm service in docker-compose.yml:
```
environment:
  PHP_IDE_CONFIG: "serverName=Docker"
```

### Create a server configuration in PHPStorm:
 * In PHPStorm open Preferences | Languages & Frameworks | PHP | Servers
 * Add new server
 * The “Name” field should be the same as the parameter “serverName” value in “environment” in docker-compose.yml (i.e. *Docker* in the example above)
 * A value of the "port" field should be the same as first port(before a colon) in "webserver" service in docker-compose.yml
 * Select "Use path mappings" and set mappings between a path to your project on a host system and the Docker container.
 * Finally, add “Xdebug helper” extension in your browser, set breakpoints and start debugging



