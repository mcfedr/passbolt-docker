# Passbolt docker

## Setting up

1. Generate gpg keys

        docker-compose -f keygen.yml run keygen
            
1. Gen http certs

        docker-compose -f letsencrypt.yml run -p 80:80 -p 443:443 letsencrypt certonly --standalone -d passbolt.com
    
1. Install

        docker-compose run web bash
        su -s /bin/bash -c "/srv/passbolt_api/app/Console/cake install --no-admin --send-anonymous-statistics=false" www-data
        su -s /bin/bash -c "PASSBOLT_APP_BASE=http://example.com /srv/passbolt_api/app/Console/cake passbolt register_user -u fred@ekreative.com -f Fred -l Cox -r admin" www-data

1. Up

        docker-compose up
