PHP Salesforce client
=====================

Supported technologies:

    - rest
        - oauth2 grant type: password.

Please, contribute to support other one.

Usage
-----

```
use WakeOnWeb\SalesforceClient\REST;
use WakeOnWeb\SalesforceClient\ClientInterface;

$client = new REST\Client(
    new REST\Gateway('https://cs81.salesforce.com', '41.0'),
    new REST\GrantType\PasswordStrategy(
        'consumer_key',
        'consumer_secret',
        'login',
        'password',
        'security_token'
    )
);

// Available methods

$client->getAvailableResources();
$client->getAllObjects();
$client->describeObjectMetadata('Account');

$client->createObject( 'Account', ['name' => 'Chuck Norrs'] );
$client->patchObject( 'Account', '1337ID', ['name' => 'Chuck Norris'] ));
$client->getObject( 'Account', '1337ID')); // all fields
$client->getObject( 'Account', '1337ID', ['Name', 'OwnerId', 'CreatedAt'] )); // specific fields
$client->deleteObject( 'Account', '1337ID'));
client->searchSOQL('SELECT name from Account'); // NOT_ALL by default.
client->searchSOQL('SELECT name from Account', ClientInterface::ALL);
```

Missing
-------

- tests
