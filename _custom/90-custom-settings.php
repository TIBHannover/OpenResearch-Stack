<?php
## set number of jobs to perform per request to 0 since we use cron (crontab -uwww-data -e)
$wgJobRunRate = 0;

## E-Mail
/*
$wgEmergencyContact = "admin@example.com";
$wgPasswordSender   = "wiki@example.com";

$wgSMTP = [
	'host' => 'mail.example.com',
	'IDHost' => 'example.com',
	'port' => 587,
	'username' => 'wiki@example.com',
	'password' => '<password>',
	'auth' => true
];
*/


## Shared memory settings
$wgMainCacheType = CACHE_MEMCACHED;
$wgParserCacheType = CACHE_MEMCACHED;
$wgMessageCacheType = CACHE_MEMCACHED;
$wgMemCachedServers = [ '127.0.0.1:11211' ];


## Timezone
/*
$wgLocaltimezone = "Europe/Berlin";
putenv("TZ=$wgLocaltimezone");
$wgLocalTZoffset = date("Z") / 60;
$wgDefaultUserOptions['timecorrection'] = 'ZoneInfo|' . (date("I") ? 120 : 60) . '|Europe/Berlin';
*/


## Default Language UPO
/*
$wgDefaultUserOptions['language'] = 'en';
*/

## File extensions
$wgFileExtensions = [ 'png', 'gif', 'jpg', 'jpeg', 'svg', 'webp' ];

## attaching licensing metadata to pages
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by-sa/2.0/de/";
$wgRightsText = "CC BY-SA licenses";
$wgRightsIcon = "https://licensebuttons.net/l/by-sa/2.0/88x31.png";