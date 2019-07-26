<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/25/2019
 * Time: 10:40 PM
 */

namespace Tests\Cipher;

use App\Cipher\CipherConstant;
use App\Cipher\Encryption\HardEncryptionAlgorithm;
use App\Exception\MethodNotImplementedException;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class HardEncryptionAlgorithmTest extends TestCase
{
    /**
     * @var string
     */
    private $fileName = CipherConstant::HARD_ENCRYPTED_FILE_PATH;

    /**
     * @param string $fileContent
     * @return HardEncryptionAlgorithm
     */
    private function setUpService(string $fileContent) {
        return new HardEncryptionAlgorithm($fileContent);
    }

    /**
     */
    public function testEncipher() {
        $hardEncryptionAlgorithm = $this->setUpService('');

        $this->expectException(MethodNotImplementedException::class);
        $hardEncryptionAlgorithm->enCipher();
    }

}