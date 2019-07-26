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
     * DataConverter constructor.
     * @param object $file
     * @param string $mode
     * @param string $complexity
     */
    public function __construct($file, string $mode, string $complexity)
    {
        $this->file = $file;
        $this->mode = $mode;
        $this->complexity = $complexity;

        if(!$this->isSupported()) {
            throw new InvalidArgumentException('One of the arguments is not valid.');
        }
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
            throw new InvalidArgumentException('Cipher mode unknown.');
        }

        if(!in_array($this->mode, CipherConstant::CIPHER_MODE)) {
            throw new InvalidArgumentException('Cipher mode invalid.');
        }

        if(! $this->complexity) {
            throw new InvalidArgumentException('Cipher complexity unknown.');
        }

        if(!in_array($this->complexity, CipherConstant::CIPHER_COMPLEXITY)) {
            throw new InvalidArgumentException('Cipher complexity not supported.');
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
            return (new EncryptionAlgorithmProvider($fileContent, $this->complexity))->find();
        }

        if($this->mode == CipherConstant::DECRYPTION) {
            return (new DecryptionAlgorithmProvider($fileContent, $this->complexity))->find();
        }

        throw new MethodNotImplementedException('Cipher algorithm not implemented.');
    }
}