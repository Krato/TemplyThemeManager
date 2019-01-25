# Theme Manager for Temply

# Instructions

1. Install Package
	```php
	composer require infinety-es/temply-theme-manager
	```

2. Config temply.php should have this config:

	```php
	'model_theme'   => App\Theme::class, // Theme Model Class
	'model_palette' => App\Palette::class, // Palette Model Class
	```
3. User model should have this attributes:

	```php
	public function getCurrentThemeAttribute()
	{
	    return \App\Theme::first();
	}

	public function getCurrentPaletteAttribute()
	{
	    return \App\Palette::first();
	}
	```

4. Add a Listener in EventServiceProvider.php
	```php
	'Infinety\TemplyThemeManager\Events\ThemeActivated' => [
        'App\Listeners\YourListener',
    ],
    ```
There are two public properties: Theme and Palette. You can access through: `$event->theme` or `$event->palette`.


