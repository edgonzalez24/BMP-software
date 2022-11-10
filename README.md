

# Sistema de control de procesos de Negocio :page_facing_up:

# Tecnologias :rocket:

<code><img height="20" src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/laravel/laravel.png"></code>
<code><img height="20" src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/composer/composer.png"></code>
<code><img height="20" src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/docker/docker.png"></code>
<code><img height="20" src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/vue/vue.png"></code>
<code><img height="20" src="https://raw.githubusercontent.com/github/explore/80688e429a7d4ef2fca1e82350fe8e3517d3494d/topics/php/php.png"></code>

# Configuración del proyecto || Proceso de construcción :wrench:

Nota: Debes de tener instalado las siguientes herramientas o técnologias
a. Apache2 o Laravel Valet

b. Mysql (Puedes instalar el entorno que prefieras)

c. Editor de código (VScode, Atom, Brackets, Sublime, etc)

d. Composer (Gestor de paquetes o dependecias para PHP)

Pasos:

1. Instalar todas las dependecias

```
composer install
```

2. Crear base de datos
   Nota: Puedes crearla con el nombre que gustes, ese nombre se añadira en las variables de entorno, en el archivo .env(raiz del proyecto)
   ̣`.env.example`

```
APP_NAME=BMP-software
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bmp_software
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=in-v3.mailjet.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=TLS
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_HOST=soketi
PUSHER_PORT=6001
PUSHER_APP_ID=app-id
PUSHER_APP_KEY=app-key
PUSHER_APP_SECRET=app-secret
PUSHER_APP_CLUSTER=mt1

VITE_MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_MIX_PUSHER_HOST="127.0.0.1"
VITE_MIX_PUSHER_PORT="${PUSHER_PORT}"
VITE_MIX_PUSHER_APP_CLUSTER="$PUSHER_APP_CLUSTER}"

VITE_GOOGLE_MAP_APP_KEY=

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

2.1 Generar key
```
php artisan key:generate
```

3. Luego de crear la base de datos, migramos los seeds a la base de datos

```
php artisan migrate:fresh --seed
```

4. Finalmente, levanta el servidor

```
php artisan serve
```

# Referencias: :memo:

Ver [Laravel](https://laravel.com).
Ver [Base de datos/Seeds](https://laravel.com/docs/8.x/seeding).
Ver [Composer](https://getcomposer.org/).
