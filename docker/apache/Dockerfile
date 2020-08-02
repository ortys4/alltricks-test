FROM debian:buster-slim

RUN set -x
RUN apt-get update -yqq && apt-get install --no-install-recommends -yqq apt-transport-https lsb-release ca-certificates wget && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ buster main" > /etc/apt/sources.list.d/php.list && \
    apt-get update -yqq && \
    apt-get install --no-install-recommends -yqq php7.4-cli php7.4-mysql php7.4-xmlrpc php7.4-xml

RUN apt-get update -yqq && apt-get install -yqq --no-install-recommends apache2 libapache2-mod-php7.4

COPY ./conf/* /etc/apache2/

EXPOSE 80
EXPOSE 443

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

