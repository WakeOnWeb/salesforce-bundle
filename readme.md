PHP Salesforce bundle
=====================

Symfony integration of [salesforce-client](https://github.com/WakeOnWeb/salesforce-client).

[![Build Status](https://api.travis-ci.org/WakeOnWeb/salesforce-bundle.svg)](https://travis-ci.org/WakeOnWeb/salesforce-bundle)

Definition
---------

```yaml
wakeonweb_salesforce:
    host: '%salesforce.host%'
    version: '%salesforce.version%'
    oauth:
        password_strategy:
            consumer_key: '%salesforce.consumer_key%'
            consumer_secret: '%salesforce.consumer_secret%'
            login: '%salesforce.login%'
            password: '%salesforce.password%'
            security_token: '%salesforce.security_token%'
```

Usage
-----

```php
$client = $container->get('wow.salesforce.client');
// see salesforce-client api.
//$client-> ...
```
