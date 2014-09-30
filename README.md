# Dashboard for CakePHP

Build beautiful dashboards for your cakes!

__This is an unstable repository and should be treated as an alpha.__

## Requirements

* CakePHP 3.0.0 or greater.
* PHP 5.4.16 or greater
* SQLite or another database driver that CakePHP can talk to (defaults to SQLite).

## Install

```
composer require gourmet/dashboard:*
```

or by adding this package to your project's `composer.json`:

```
"require": {
	"gourmet/dashboard": "*"
}
```

You will also need to symlink the assets:

|From                                                    |To                             |
|--------------------------------------------------------|-------------------------------|
|`plugin/Gourmet/Dashboard/webroot/assets/dashboard.css` |`webroot/assets/dashboard.css` |
|`plugin/Gourmet/Dashboard/webroot/assets/dashboard.js`  |`webroot/assets/dashboard.js`  |
|`plugin/Gourmet/Dashboard/webroot/font`                 |`webroot/font/dashboard`       |

To preview the sample dashboard, you will need to also copy some sample widgets to your app:

|From                               |To                    |
|-----------------------------------|----------------------|
|`plugin/Gourmet/Dashboard/samples` |`src/DashboardWidget` |

That's it! You can now access the sample dashboard at: http://localhost/gourmet/dashboard/index

## Documentation

### Database Configuration

By default, Dashboard will store event data into a SQLite database in your application's `tmp` directory. If
you cannot install pdo_sqlite, you can configure Dashboard to use a different database by defining a
`gourmet_dashboard` connecting in your `config/app.php` file.

### Widgets

#### Built-in Widgets

There are several built-in widgets, they are:

* Clock
* Comments
* Graph
* Iframe
* Image
* List
* Meter
* Number
* Text

### Configuration

There is no configuration at this time. Options will be coming soon.

### Developing Your Own Widgets

You can create your own custom widgets for Gourmet/Dashboard. Until this is better documented, please refer
to the sample widgets included.

## Credits

* [Shopify/dashing](https://github.com/shopify/dashing/) - the Sinatra application this plugin replicates
* [cakephp/debug_kit](https://github.com/cakephp/debug_kit/) - the SQLite implementation
