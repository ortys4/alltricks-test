FROM debian:buster-slim

ENV DEBIAN_FRONTEND noninteractive
ENV TZ Europe/Paris
ENV COMPOSER_HOME /composer
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN set -x
RUN apt-get update -yqq && apt-get install --no-install-recommends -yqq apt-transport-https lsb-release ca-certificates wget && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ buster main" > /etc/apt/sources.list.d/php.list && \
    apt-get update -yqq && \
    apt-get install --no-install-recommends -yqq php7.4-cli php7.4-mysql php7.4-xmlrpc php7.4-xml

COPY ./bin/* /usr/local/bin/

RUN chmod +x ./usr/local/bin/*

RUN docker-build-composer

ENTRYPOINT ["docker-entrypoint"]
CMD ["php", "-a"]