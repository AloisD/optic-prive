
# Optic Prive

Optic Privé is a platform that connects buyers and opticians on the internet



## Install
1/ Create in the optic-prive-back folder a file env.local (insert the code below)

APP_ENV=dev
APP_SECRET=4372073d7e45d35fc6b7b8a1552c9da0

DATABASE_URL="mysql://root@127.0.0.1:3306/optic-prive?serverVersion=5.7"
###> nelmio/cors-bundle ###
CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'
###< nelmio/cors-bundle ###

###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=78f0aacd3bc19266e25f8019c6d1b039
###< lexik/jwt-authentication-bundle ###
COOKIE_DOMAIN=localhost

2/ composer install

3/ npm install

4/ symfony console lexik:jwt:generate-keypair

5/ symfony console doctrine:database:create

6/ symfony console doctrine:migrations:migrate

7/ symfony console doctrine:fixtures:load

8/ npm run dev

### Into folder's optic-prive-front

9/ npm install

## Launch apps
### Into folder's optic-prive-back

symfony server:start --allow-http

### Into folder's optic-prive-front

ng serve





