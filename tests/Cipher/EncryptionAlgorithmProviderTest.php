<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/25/2019
 * Time: 10:40 PM
 */

namespace Tests\Cipher;


use App\Cipher\CipherConstant;
use App\Cipher\Encryption\EncryptionAlgorithmProvider;
use App\Cipher\Encryption\HardEncryptionAlgorithm;
use App\Cipher\Encryption\SimpleEncryptionAlgorithm;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class EncryptionAlgorithmProviderTest extends TestCase
{
    /**
     * @var EncryptionAlgorithmProvider
     */
    private $encryptionAlgorithmProvider;

    /**
     * @return void
     */
    public function setUp() {
        $simpleAlgorithmMock = $this->createMock(SimpleEncryptionAlgorithm::class);
        $simpleAlgorithmMock->method('with')->withAnyParameters()->willReturn(new SimpleEncryptionAlgorithm());

        $hardAlgorithmMock   = $this->createMock(HardEncryptionAlgorithm::class);
        $hardAlgorithmMock->method('with')->withAnyParameters()->willReturn(new HardEncryptionAlgorithm());

        $this->encryptionAlgorithmProvider = new EncryptionAlgorithmProvider($simpleAlgorithmMock, $hardAlgorithmMock);

        parent::setUp();
    }

    /**
     */
    public function testFind() {
        $simpleAlgorithm = $this->encryptionAlgorithmProvider->find('abc', CipherConstant::SIMPLE);
        $this->assertInstanceOf(SimpleEncryptionAlgorithm::class, $simpleAlgorithm);

        $hardAlgorithm = $this->encryptionAlgorithmProvider->find('abc', CipherConstant::HARD);
        $this->assertInstanceOf(HardEncryptionAlgorithm::class, $hardAlgorithm);
    }

}