# PlasmaWalls, the Plasma wallpaper downloader

> PlasmaWalls developers are not affiliate with Plasma, this project is neither created, maintained nor endorsed by the Plasma developers.

> Public instance running at https://plasmawalls.alwaysdata.net. Other users: PLEASE update to version 1.1 or later (2.0 recommanded) and change your token, the initial release has some token leak problems.

The project is to have a public website where users could download all Plasma 5 wallpapers without having to dig through the Git repository.

# Getting started
First, make sure you have a webserver running PHP 7.0 or later (not yet tested with PHP 8), and that this server can access the Internet (especially `invent.kde.org`)

Then, create a `KEY.txt` file at the root to add your invent.kde.org API key (with the permissions `read_api` and `read_repository`), it is required to access the repository.

> Make sure the `.htaccess` file is working correctly to prevent users from accessing the `KEY.txt` (and **[NEW]**, the `cache` folder) file.

## **NEW IN 2.0 :** Caching
Starting with PlasmaWalls 2.0, a smart caching system will be used. It will build the cache every month.

The release comes with a default cache built earlier. If PlasmaWalls is unable to reach KDE's GitLab servers, you will need to tweak the cache so that it doesn't try to rebuild.

To manually rebuild the cache, run the `private/cache.php` PHP script from a command line interface.

# Report bugs
Just use GitLab's issues system. PlasmaWalls depends on Bootstrap, so bugs with the mainline Bootstrap should be reported to Bootstrap team.

Before reporting a bug,  please check if it's not a problem on your side (try with a clean browser).
