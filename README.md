# Monitor Laravel scheduled jobs with ease

This Laravel 5 package allows you to monitor all scheduled jobs, adding this command "php artisan schedule:overview". This command will print all relevant informations about jobs.

## Getting Started

These instructions allows you to install the package into an existing Laravel app.

### Prerequisities

Laravel 5 up&running installation.


### Installation

You can install this package via Composer using:

```bash
composer require michelecurletta/laravel-schedule-overview
```

You must also install this service provider.

```php
// config/app.php
'providers' => [
    ...
    MicheleCurletta\LaravelScheduleOverview\ScheduleOverviewServiceProvider::class,
    ...
];
```

### Usage

Once you have installed the package, you can run the following command:

```bash
php artisan schedule:overview
```

You will see the list os scheduled jobs with all relevant details.

![Alt text](/images/schedule_overview.png?raw=true "Laravel schedule overview")

All done!

### Suggestion

Use this command before you deploy you applications, in order to check the jobs frequency and timing.
Enjoy.
