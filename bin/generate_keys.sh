#!/usr/bin/env sh
mkdir -p config/jwt
jwt_passhrase=$(grep ''^JWT_PASSPHRASE='' .env.local | cut -f 2 -d ''='')
echo "$jwt_passhrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
echo "$jwt_passhrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
#chown -R www-data config/jwt
chmod -R u+rx config/jwt