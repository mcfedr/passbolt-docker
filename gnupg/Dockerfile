FROM ubuntu:xenial
MAINTAINER Fred Cox <mcfedr@gmail.com>

RUN apt-get update \
    && apt-get install -y gnupg \
    && apt-get autoremove -y \
    && apt-get clean all

CMD [ "gpg" ]
