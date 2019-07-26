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
     * @var SimpleEncryptionAlgorithm
     */
    private $simpleEncryptionAlgorithm;

    /**
     * @var HardEncryptionAlgorithm
     */
    private $hardEncryptionAlgorithm;

    /**
     * EncryptionAlgorithmProvider constructor.
     * @param SimpleEncryptionAlgorithm $simpleEncryptionAlgorithm
     * @param HardEncryptionAlgorithm $hardEncryptionAlgorithm
     */
    public function __construct(SimpleEncryptionAlgorithm $simpleEncryptionAlgorithm, HardEncryptionAlgorithm $hardEncryptionAlgorithm)
    {
        $this->simpleEncryptionAlgorithm = $simpleEncryptionAlgorithm;
        $this->hardEncryptionAlgorithm = $hardEncryptionAlgorithm;
    }

    /**
     * @param string $fileContent
     * @param string $cipherComplexity
     * @return EncryptionAlgorithm
     * @throws MethodNotImplementedException
     */
    public function find(string $fileContent, string $cipherComplexity)
    {

        if($cipherComplexity == CipherConstant::SIMPLE) {
            return $this->simpleEncryptionAlgorithm->with($fileContent);

        } else if($cipherComplexity == CipherConstant::HARD) {
            return $this->hardEncryptionAlgorithm->with($fileContent);
        }

        throw new MethodNotImplementedException('Cipher algorithm not implemented.');
    }

}