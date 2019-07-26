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
     * @var string
     */
    private $cipherComplexity;

    /**
     * @var string
     */
    private $fileContent;

    /**
     * EncryptionAlgorithmProvider constructor.
     * @param $fileContent
     * @param $cipherComplexity
     */
    public function __construct($fileContent, $cipherComplexity)
    {
        $this->cipherComplexity = $cipherComplexity;
        $this->fileContent = $fileContent;
    }

    /**
     * @return mixed
     * @throws MethodNotImplementedException
     */
    public function find()
    {

        if($this->cipherComplexity == CipherConstant::SIMPLE) {
            return (new SimpleDecryptionAlgorithm($this->fileContent))->writeToFile();

        } else if($this->cipherComplexity == CipherConstant::HARD) {
            return (new HardDecryptionAlgorithm($this->fileContent))->writeToFile();
        }

        throw new MethodNotImplementedException('Cipher algorithm not implemented.');
    }
}