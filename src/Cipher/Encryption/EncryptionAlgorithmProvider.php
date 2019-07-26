<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Encryption;


use App\Cipher\CipherConstant;
use App\Exception\MethodNotImplementedException;

class EncryptionAlgorithmProvider implements EncryptionAlgorithmProviderInterface
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
     * @param string $fileContent
     * @param string $cipherComplexity
     */
    public function __construct(string $fileContent, string $cipherComplexity)
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
            return (new SimpleEncryptionAlgorithm($this->fileContent))->writeToFile();

        } else if($this->cipherComplexity == CipherConstant::HARD) {
            return (new HardEncryptionAlgorithm($this->fileContent))->writeToFile();
        }

        throw new MethodNotImplementedException('Cipher algorithm not implemented.');
    }

}