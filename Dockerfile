FROM ubuntu

ARG DEBIAN_FRONTEND=noninteractive
ARG FA_LICENSE=""
ENV FA_LICENSE=${FA_LICENSE}

WORKDIR /app

RUN apt -yqq update && \
apt -yqq install curl wget software-properties-common tzdata git && \
unlink /etc/localtime && \
ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime && \
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.2/install.sh | bash && \
add-apt-repository --yes ppa:ondrej/php && \
apt -yqq update && \
apt install -yqq php7.3 php7.3-cli php7.3-common php7.3-curl php7.3-mbstring php7.3-mysql php7.3-xml php7.3-pgsql php7.3-zip && \
. ~/.nvm/nvm.sh && \
nvm install 12 && \
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
# php composer-setup.php --version=1.10.26 && \
php composer-setup.php && \
php -r "unlink('composer-setup.php');" && \
mv composer.phar /usr/local/bin/composer

COPY ./ /app

# Source npm
RUN . ~/.nvm/nvm.sh && \
npm config set "@fortawesome:registry" https://npm.fontawesome.com/ && \
npm config set "//npm.fontawesome.com/:_authToken" $FA_LICENSE


ENTRYPOINT [ "./entrypoint.sh" ]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
