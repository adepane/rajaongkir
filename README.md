## Instalation

change the .env database to your's in section below
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dothiring
DB_USERNAME=root
DB_PASSWORD=
```

change the .env RAJA ONGKIR KEY in section below:
```
RAJA_ONGKIR_KEY=
```

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

Migrate all Database
```
php artisan migrate
```

Fetch all Raja Ongkir Provinces to DB
```
php artisan rajaogkir:province
```

Fetch all Raja Ongkir Cities to DB
```
php artisan rajaogkir:city
```

To swap between DB or Direct to Raja Ongkir change the .env in section below:
```
# SWAPPABLE OPTION {db | direct}
RAJA_ONGKIR_SWAPPABLE=db
```
db = Get from database
direct = Get from raja ongkir

Postman details API
```
https://documenter.getpostman.com/view/4929641/2s9YBxacHE
```