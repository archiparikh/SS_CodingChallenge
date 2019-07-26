<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/25/2019
 * Time: 10:40 PM
 */

namespace Tests\Cipher;

use App\Cipher\CipherConstant;
use App\Cipher\Decryption\DecryptionAlgorithmProvider;
use App\Cipher\Decryption\HardDecryptionAlgorithm;
use App\Cipher\Decryption\SimpleDecryptionAlgorithm;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class DecryptionAlgorithmProviderTest extends TestCase
{
    /**
     * @var DecryptionAlgorithmProvider
     */
    private $decryptionAlgorithmProvider;

    /**
     * @return void
     */
    public function setUp() {
        $simpleAlgorithmMock = $this->createMock(SimpleDecryptionAlgorithm::class);
        $simpleAlgorithmMock->method('with')->withAnyParameters()->willReturn(new SimpleDecryptionAlgorithm());

        $hardAlgorithmMock   = $this->createMock(HardDecryptionAlgorithm::class);
        $hardAlgorithmMock->method('with')->withAnyParameters()->willReturn(new HardDecryptionAlgorithm());

        $this->decryptionAlgorithmProvider = new DecryptionAlgorithmProvider($simpleAlgorithmMock, $hardAlgorithmMock);

        parent::setUp();
    }

    /**
     */
    public function testFind() {
        $simpleAlgorithm = $this->decryptionAlgorithmProvider->find('abc', CipherConstant::SIMPLE);
        $this->assertInstanceOf(SimpleDecryptionAlgorithm::class, $simpleAlgorithm);

        $hardAlgorithm = $this->decryptionAlgorithmProvider->find('abc', CipherConstant::HARD);
        $this->assertInstanceOf(HardDecryptionAlgorithm::class, $hardAlgorithm);
    }

}