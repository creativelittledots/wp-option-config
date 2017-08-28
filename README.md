# WP Option Config

This is a MU Plugin for Wordpress that helps to control options by filtering checks to a config file for options when calling get_option function.

Just upload `wp-option-config.php` to your `mu-plugins/` folder, add the `config.php` file to the root of your Wordpress installation and start adding your options as required.

WP Option Config supports `WPMU` as all options are filtered through `config.php` regardless of the current `blog_id`. Here are some ways you can write conditions for `WPMU` or you general environment:

```php
// config.php

return [

    'smtp_host'     => WESAYY_ENV == 'TESTING' ? 'smtp.mailtrap.io' : 'smtp.sparkpostmail.com',
    'smtp_port'     => WESAYY_ENV == 'TESTING' ? 2525 : 587,
    'smtp_user'     => WESAYY_ENV == 'TESTING' ? 'username' : 'another_username',
    'smtp_pass'     => WESAYY_ENV == 'TESTING' ? 'passwors' : 'another_password',

];
```
