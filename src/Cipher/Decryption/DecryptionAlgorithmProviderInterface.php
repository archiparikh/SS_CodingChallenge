<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Decryption;


interface DecryptionAlgorithmProviderInterface
{
    /**
     * @param string $fileContent
     * @param string $cipherComplexity
     * @return DecryptionAlgorithm
     */
    function find(string $fileContent, string $cipherComplexity);

}