Lastfm-Dynamic-Image
====================

This generates an image showing the last played song in your Last.fm history.

##Usage

Edit the first lines of the PHP files.

    $username = 'YourLastFmUsername';
    $apikey = 'YourLastFmApiKey';

If you don't have an API key, you can get one [here](http://www.last.fm/api/account/create).

This script is designed to be run on a cron. The suggested method is to add it to crontab via `crontab -e`.

For example, to regenerate the image every 5 minutes, add `*/5 * * * * php /var/www/index.php` to your crontab.
