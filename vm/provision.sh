sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get -y update
sudo apt-get install -y php7.1 php7.1-xml php7.1-mysql php7.1-curl php7.1-mbstring

sudo a2dismod php7.0
sudo a2enmod php7.1
sudo service apache2 restart

sudo /usr/local/bin/composer self-update

cd /var/www

composer install

sudo mysql -u root -proot scotchbox < vm/database.sql
