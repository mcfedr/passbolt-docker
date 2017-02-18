FROM ubuntu:xenial
MAINTAINER Fred Cox <mcfedr@gmail.com>

RUN apt-get update \
    && apt-get install -y gnupg \
    && apt-get autoremove -y \
    && apt-get clean all

ADD generate_gpg_server_key.sh /srv
ADD gpg_server_key_settings.conf /srv
CMD [ "/srv/generate_gpg_server_key.sh" ]
