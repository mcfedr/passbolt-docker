# Passbolt docker

## Setting up

1. Generate gpg keys

    docker-compose -f docker-compose.keygen.yml run keygen
    
2. Install

    docker-compose run web bash
    su -s /bin/bash -c "/srv/passbolt_api/app/Console/cake install --no-admin --send-anonymous-statistics=false" www-data
    su -s /bin/bash -c "PASSBOLT_APP_BASE=http://example.com /srv/passbolt_api/app/Console/cake passbolt register_user -u fred@ekreative.com -f Fred -l Cox -r admin" www-data
