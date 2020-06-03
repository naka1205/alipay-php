# alipay-php


### 用户授权
```php

use Alipay\Client;

$auth_code = $_GET['auth_code'];
$config = [
    'appid'       =>  'app_id',
    'gateway'     =>  'https://openapi.alipay.com/gateway.do',
    'public'      =>  'public_key',
    'private'     =>  'private_key'
];
$aop = new Client($config);
$response = $aop->getToken($auth_code);
var_dump($response);

```