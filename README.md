## Instalation

clone this repo
```
git clone https://github.com/adepane/rajaongkir.git "yourdirname"
```

```
cd yourdirname
```

install all vendor
```
composer install
```

After you done with it, now please create new key
```
php artisan key:generate
```

Before access the installer, purge the all configuration
```
php artisan optimize:clear
```

To run it in the browser, you can use valet like `yourdirname.test`, or if you don't have valet installed, you run development serve like so
```
php artisan serve
```

## Preparing DB
change the .env database to your's in section below
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dothiring
DB_USERNAME=root
DB_PASSWORD=
```

Migrate all Database
```
php artisan migrate
```

## Change Raja Ongkir Key

change the .env RAJA ONGKIR KEY in section below:
```
RAJA_ONGKIR_KEY=
```

## Fetch data from Raja Ongkir with command

Fetch all Raja Ongkir Provinces to DB
```
php artisan rajaogkir:province
```

Fetch all Raja Ongkir Cities to DB
```
php artisan rajaogkir:city
```

## Change request between Database or Direct to Raja Ongkir

To swap between DB or Direct to Raja Ongkir change the .env in section below:
```
# SWAPPABLE OPTION {db | direct}
RAJA_ONGKIR_SWAPPABLE=db
```
- db = Get from database
- direct = Get from raja ongkir

## User with command / Seeder

Create new user with command (prompt will show up)
```
php artisan create:admin
```

Seeder user
```
php artisan db:seed
```

After seeder please using this credential below:

```
email: admin@gg.com
password: admin123
```

## Unit Test

Postman details API
```
php artisan test
```


# Postman documentation

Postman details API
```
https://documenter.getpostman.com/view/4929641/2s9YBxacHE
```