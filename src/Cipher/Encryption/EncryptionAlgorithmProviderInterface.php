<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Encryption;


interface EncryptionAlgorithmProviderInterface
{
    /**
     * @param string $fileContent
     * @param string $cipherComplexity
     * @return EncryptionAlgorithm
     */
    function find(string $fileContent, string $cipherComplexity);

}