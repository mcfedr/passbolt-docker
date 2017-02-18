#!/bin/sh
gpg --batch --armor --gen-key /srv/gpg_server_key_settings.conf
mv gpg_server_key_public.key /srv/keys
mv gpg_server_key_private.key /srv/keys
chown -R www-data:www-data /srv/keys
