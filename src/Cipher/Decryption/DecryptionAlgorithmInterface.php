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
     * @param string $fileContent
     * @return DecryptionAlgorithmInterface
     */
    function with(string $fileContent);

    /**
     * @return mixed
     */
    function writeToFile();

    /**
     * @return mixed
     */
    function deCipher();
}