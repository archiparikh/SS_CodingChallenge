<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Decryption;

use App\Cipher\CipherConstant;
use App\Exception\MethodNotImplementedException;

class DecryptionAlgorithmProvider implements DecryptionAlgorithmProviderInterface
{
    /**
     * @var SimpleDecryptionAlgorithm
     */
    private $simpleDecryptionAlgorithm;

    /**
     * @var HardDecryptionAlgorithm
     */
    private $hardDecryptionAlgorithm;

    /**
     * EncryptionAlgorithmProvider constructor.
     * @param SimpleDecryptionAlgorithm $simpleDecryptionAlgorithm
     * @param HardDecryptionAlgorithm $hardDecryptionAlgorithm
     */
    public function __construct(SimpleDecryptionAlgorithm $simpleDecryptionAlgorithm, HardDecryptionAlgorithm $hardDecryptionAlgorithm)
    {
        $this->simpleDecryptionAlgorithm = $simpleDecryptionAlgorithm;
        $this->hardDecryptionAlgorithm = $hardDecryptionAlgorithm;
    }

    /**
     * @param $fileContent
     * @param $cipherComplexity
     * @return DecryptionAlgorithm
     * @throws MethodNotImplementedException
     */
    public function find(string $fileContent, string $cipherComplexity)
    {

        if($cipherComplexity == CipherConstant::SIMPLE) {
            return $this->simpleDecryptionAlgorithm->with($fileContent);

        } else if($cipherComplexity == CipherConstant::HARD) {
            return $this->hardDecryptionAlgorithm->with($fileContent);
        }

        throw new MethodNotImplementedException('Cipher algorithm not implemented.');
    }
}