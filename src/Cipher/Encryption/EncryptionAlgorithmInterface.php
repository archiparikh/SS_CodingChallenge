<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Encryption;

interface EncryptionAlgorithmInterface
{
    /**
     * @param string $fileContent
     * @return EncryptionAlgorithmInterface
     */
    function with(string $fileContent);

    /**
     * @return mixed
     */
    function writeToFile();

    /**
     * @return mixed
     */
    function enCipher();
}