<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Decryption;

use App\Exception\MethodNotImplementedException;

class HardDecryptionAlgorithm extends DecryptionAlgorithm
{
    /**
     * @return mixed|void
     * @throws MethodNotImplementedException
     */
    public function deCipher()
    {
        throw new MethodNotImplementedException('Method not implemented.');
    }
}