<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Encryption;


use App\Exception\MethodNotImplementedException;

class HardEncryptionAlgorithm extends EncryptionAlgorithm
{
    /**
     * @return mixed|void
     * @throws MethodNotImplementedException
     */
    public function enCipher()
    {
        throw new MethodNotImplementedException('Method not implemented.');
    }
}