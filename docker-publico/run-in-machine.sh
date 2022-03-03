sudo apt update
sudo apt-get upgrade

## permissao na pasta
sudo chmod -R 777 /publico

## Install Composer
sudo apt install php-cli unzip -y
sudo apt install php-curl php-tokenizer php-mbst ctring php-calendar php-imap php-bz2 php8 php-dev -y
sudo apt remove --purge apache2 -y

#driver do mysql
sudo apt-get install php7.4-mysql
sudo apt-get install php8.0-mysql
sudo apt-get install php8.1-mysql

#instala node js
cd ~
curl -sL https://deb.nodesource.com/setup_16.x -o nodesource_setup.sh
echo $HASH
sudo bash nodesource_setup.sh
sudo apt install nodejs
echo "Verifing node js installation..."
node -v

cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
HASH=`curl -sS https://composer.github.io/installer.sig`
echo $HASH
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
echo "Verifing composer installation..."
composer

## Install node
sudo apt install nodejs
echo "Verifing node installation..."
nodejs -v
sudo apt install npm
echo "Verifing npm installation..."
npm -v

## Install imagick
sudo apt-get install php-imagick

## Install docker 
sudo apt install docker.io
sudo apt  install docker-compose

## Run docker
cd /publico/docker-publico
sudo chmod -R 777 /publico/backend/storage
sudo docker-compose --env-file /publico/backend/.env up -d --build 