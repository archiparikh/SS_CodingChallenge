<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/23/2019
 * Time: 12:42 PM
 */

namespace App\Cipher\Decryption;
use App\Cipher\CipherConstant;


/**
 * Class DecryptionAlgorithm
 * @package App\Cipher\Encryption
 */
abstract class DecryptionAlgorithm implements DecryptionAlgorithmInterface
{
    /**
     * @var string
     */
    protected $fileContent;

    /**
     * DecryptionAlgorithm constructor.
     * @param string $fileContent
     * @return DecryptionAlgorithm
     */
    public abstract function with(string $fileContent);

    /**
     * @return string
     */
    public function writeToFile()
    {
        $decryptedData = $this->deCipher();
        file_put_contents(CipherConstant::DECRYPTED_FILE_PATH, $decryptedData);

        return $decryptedData;
    }

    public abstract function deCipher();
}