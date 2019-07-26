<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/25/2019
 * Time: 10:40 PM
 */

namespace Tests\Cipher;

use App\Cipher\CipherConstant;
use App\Cipher\Decryption\HardDecryptionAlgorithm;
use App\Exception\MethodNotImplementedException;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class HardDecryptionAlgorithmTest extends TestCase
{
    /**
     * @var string
     */
    private $fileName = CipherConstant::HARD_DECRYPTED_FILE_PATH;

    /**
     * @param string $fileContent
     * @return HardDecryptionAlgorithm
     */
    private function setUpService(string $fileContent) {
        return new HardDecryptionAlgorithm($fileContent);
    }

    /**
     */
    public function testEncipher() {
        $hardDecryptionAlgorithm = $this->setUpService('');

        $this->expectException(MethodNotImplementedException::class);
        $hardDecryptionAlgorithm->deCipher();
    }

}