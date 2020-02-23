<?php

namespace Repack\Encryption;

use ArrayAccess;

class Bootstrapper
{
    public static function bootstrap(ArrayAccess $ioc)
    {
        $ioc->singleton('encrypter', function () use ($ioc) {
            $config = $ioc['config']->get('app');

            // If the key starts with "base64:", we will need to decode the key before handing
            // it off to the encrypter. Keys may be base-64 encoded for presentation and we
            // want to make sure to convert them back to the raw bytes before encrypting.
            $key = $config['key'];

            $needle = 'base64:';

            $isBase64 = ($needle != '' && substr($key, 0, strlen($needle)) === (string) $needle) ? true : false;

            if ($isBase64) {
                $key = base64_decode(substr($key, 7));
            }

            return new Encrypter($key, $config['cipher']);
        });
    }
}
