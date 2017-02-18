<?php
/**
 * Main application configuration file
 *
 * @copyright (c) 2015-present Bolt Softwares Pvt Ltd
 * @licence GNU Affero General Public License http://www.gnu.org/licenses/agpl-3.0.en.html
 */
$config = [
	// General App Details
	'App' => [
		// Should the app be SSL / HTTPS only
		// false will render your installation insecure
		'ssl' => [
			'force' => false,
		],
		// Is public registration allowed
		'registration' => [
			'public' => false,
		],
		// Activate specific entry points for selenium testing.
		// true will render your installation insecure
		'selenium' => [
			'active' => false,
		],
		// Do you want search engine robots to index your site
		// Default is set to false
		'meta' => [
			'robots' => [
				'index' => false,
			]
		],
	],
	// Analytics configuration
	'Analytics' => [
		'piwik' => [
			// Provide an url to activate tracking.
			// 'url' => ''
		],
	],
	// GPG Configuration
	'GPG' => [
		// Tell GPG where to find the keyring
		// Needs to be available by the user the webserver is running as
		'env' => [
			// you can set this to false if you want to use *nix $GNUPGHOME environment variable
			'setenv' => false,
			// otherwise you can set the location here
			// typically on Centos it would be in '/usr/share/httpd/.gnupg'
			'home' => '/srv/keys',
		],
		// Main server key
		'serverKey' => [
			// Server private key location and fingerprint
			'public' => '/srv/keys/gpg_server_key_public.key',
			'private' => '/srv/keys/gpg_server_key_private.key',

			// PHP Gnupg module currently does not support passphrase, please leave blank
			'passphrase' => ''
		]
	]
];

if (!class_exists('\Passbolt\Gpg')) {
    App::import( 'Model/Utility', 'Gpg' );
}
$gpg = new Passbolt\Gpg();
$privateKeydata = file_get_contents($config['GPG']['serverKey']['private']);
$privateKeyInfo = $gpg->getKeyInfo($privateKeydata);
$config['GPG']['serverKey']['fingerprint'] = $privateKeyInfo['fingerprint'];
