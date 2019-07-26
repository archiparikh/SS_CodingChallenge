<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/25/2019
 * Time: 10:40 PM
 */

namespace Tests\Cipher;

use App\Cipher\CipherConstant;
use App\Cipher\CipherProvider;
use App\Cipher\Decryption\DecryptionAlgorithmProvider;
use App\Cipher\Encryption\EncryptionAlgorithmProvider;
use App\Cipher\Encryption\HardEncryptionAlgorithm;
use App\Cipher\Encryption\SimpleEncryptionAlgorithm;
use App\Exception\InvalidCipherComplexityException;
use App\Exception\InvalidCipherModeException;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\HttpFoundation\File\File;

class CipherProviderTest extends TestCase
{
    /**
     * @var CipherProvider
     */
    private $cipherProvider;

    /**
     * @return void
     */
    public function setUp() {
        $encryptionAlgorithmProvider = $this->createMock(EncryptionAlgorithmProvider::class);
        $decryptionAlgorithmProvider = $this->createMock(DecryptionAlgorithmProvider::class);

        $this->cipherProvider = new CipherProvider($encryptionAlgorithmProvider, $decryptionAlgorithmProvider);

        parent::setUp();
    }

    /**
     */
    public function testIsSupported() {
        $cipherProvider = $this->cipherProvider->with(new File(CipherConstant::ENCRYPTED_FILE_PATH), CipherConstant::ENCRYPTION, CipherConstant::SIMPLE);
        $this->assertTrue($cipherProvider->isSupported());

        $cipherProvider = $this->cipherProvider->with(new File(CipherConstant::ENCRYPTED_FILE_PATH), CipherConstant::ENCRYPTION, CipherConstant::HARD);
        $this->assertTrue($cipherProvider->isSupported());

        $cipherProvider = $this->cipherProvider->with(new File(CipherConstant::ENCRYPTED_FILE_PATH), CipherConstant::DECRYPTION, CipherConstant::SIMPLE);
        $this->assertTrue($cipherProvider->isSupported());

        $cipherProvider = $this->cipherProvider->with(new File(CipherConstant::ENCRYPTED_FILE_PATH), CipherConstant::DECRYPTION, CipherConstant::HARD);
        $this->assertTrue($cipherProvider->isSupported());

        $this->expectException(InvalidCipherModeException::class);
        $this->cipherProvider->with(new File(CipherConstant::ENCRYPTED_FILE_PATH), 'asda', CipherConstant::HARD);

        $this->expectException(InvalidCipherComplexityException::class);
        $this->cipherProvider->with(new File(CipherConstant::ENCRYPTED_FILE_PATH), CipherConstant::DECRYPTION, 'asd');

    }

    /*public function testCipher() {

    }*/
}