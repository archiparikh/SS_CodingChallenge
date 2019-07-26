<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Decryption;

interface DecryptionAlgorithmInterface
{
    /**
     * @return mixed
     */
    function writeToFile();

    /**
     * @return mixed
     */
    function deCipher();
}