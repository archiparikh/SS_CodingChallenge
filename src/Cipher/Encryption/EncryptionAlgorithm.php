<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Encryption;
use App\Cipher\CipherConstant;


/**
 * Class DecryptionAlgorithm
 * @package App\Cipher\Encryption
 */
abstract class EncryptionAlgorithm implements EncryptionAlgorithmInterface
{
    /**
     * @var string
     */
    protected $fileContent;

    /**
     * DecryptionAlgorithm constructor.
     * @param string $fileContent
     */
    public function __construct(string $fileContent)
    {

        $this->fileContent = $fileContent;
    }

    /**
     * @return string
     */
    public function writeToFile()
    {
        $encryptedData = $this->enCipher();
        file_put_contents(CipherConstant::ENCRYPTED_FILE_PATH, $encryptedData);

        return $encryptedData;
    }

    public abstract function enCipher();
}