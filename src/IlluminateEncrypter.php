<?php
namespace Repack\Encryption;

use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;

class IlluminateEncrypter extends Encrypter implements EncrypterContract
{
    // Illuminate >=5.0.0
}
