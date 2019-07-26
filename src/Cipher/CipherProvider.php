<?php
/**
 * Created by PhpStorm.
 * User: archi.parikh
 * Date: 11/17/2017
 * Time: 8:18 PM
 */

namespace App\Cipher;

use App\Cipher\Decryption\DecryptionAlgorithmProvider;
use App\Cipher\Encryption\EncryptionAlgorithmProvider;
use App\Exception\InvalidCipherComplexityException;
use App\Exception\InvalidCipherModeException;
use App\Exception\MethodNotImplementedException;
use InvalidArgumentException;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * Class CipherProvider
 * @package App\Cipher\CipherProvider
 */
class CipherProvider implements CipherProviderInterface {

    /**
     * @var object
     */
    private $file;

    /**
     * @var string
     */
    private $mode;

    /**
     * @var string
     */
    private $complexity;

    /**
     * @var EncryptionAlgorithmProvider
     */
    private $encryptionAlgorithmProvider;

    /**
     * @var DecryptionAlgorithmProvider
     */
    private $decryptionAlgorithmProvider;

    /**
     * CipherProvider constructor.
     * @param EncryptionAlgorithmProvider $encryptionAlgorithmProvider
     * @param DecryptionAlgorithmProvider $decryptionAlgorithmProvider
     */
    public function __construct(EncryptionAlgorithmProvider $encryptionAlgorithmProvider, DecryptionAlgorithmProvider $decryptionAlgorithmProvider)
    {
        $this->encryptionAlgorithmProvider = $encryptionAlgorithmProvider;
        $this->decryptionAlgorithmProvider = $decryptionAlgorithmProvider;
    }

    /**
     * @param object $file
     * @param string $mode
     * @param string $complexity
     * @return CipherProvider
     */
    public function with($file, string $mode, string $complexity)
    {
        $this->file = $file;
        $this->mode = $mode;
        $this->complexity = $complexity;

        if(!$this->isSupported()) {
            throw new InvalidArgumentException('One of the arguments is not valid.');
        }

        return $this;
    }

    /**
     * @throws InvalidArgumentException
     * @return boolean
     */
    public function isSupported()
    {
        if(! $this->file) {
            throw new FileNotFoundException('File not found.');
        }

        if(! $this->mode) {
            throw new InvalidCipherModeException('Cipher mode unknown.');
        }

        if(!in_array($this->mode, CipherConstant::CIPHER_MODE)) {
            throw new InvalidCipherModeException('Cipher mode invalid.');
        }

        if(! $this->complexity) {
            throw new InvalidCipherComplexityException('Cipher complexity unknown.');
        }

        if(!in_array($this->complexity, CipherConstant::CIPHER_COMPLEXITY)) {
            throw new InvalidCipherComplexityException('Cipher complexity not supported.');
        }

        return true;
    }

    /**
     * @return mixed
     * @throws MethodNotImplementedException
     */
    public function cipher()
    {
        $fileContent = file_get_contents($this->file);

        if(!$fileContent) {
            throw new InvalidArgumentException('File content is empty.');
        }

        if($this->mode == CipherConstant::ENCRYPTION) {
            return $this->encryptionAlgorithmProvider->find($fileContent, $this->complexity)->writeToFile();
        }

        if($this->mode == CipherConstant::DECRYPTION) {
            return $this->decryptionAlgorithmProvider->find($fileContent, $this->complexity)->writeToFile();
        }

        throw new MethodNotImplementedException('Cipher algorithm not implemented.');
    }
}