<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/25/2019
 * Time: 10:40 PM
 */

namespace Tests\Cipher;

use App\Cipher\CipherConstant;
use App\Cipher\Decryption\SimpleDecryptionAlgorithm;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class SimpleDecryptionAlgorithmTest extends TestCase
{
    /**
     * @var string
     */
    private $fileName = CipherConstant::SIMPLE_DECRYPTED_FILE_PATH;

    public function fileData() {
        return [
            ['', ''],
            ['zhimneyxwvutsrqpolkjgfdcba', 'abcdefghijklmnopqrstuvwxyz'],
            ['jxn jlzynmb qe lqsnq zrm vgtwnj

              hb dwttwzs kxzunkpnzln

              mlzszjwk pnlkqrzn

              ixqlgk.

              nkiztgk, plwrin qe fnlqrz.
              pzlwk, z bqgry iqgrj, uwrkszr jq jxn plwrin.
              sqrjzygn, xnzmk qe jdq xqgknk zj fzlwzrin dwjx nzix qjxnl.
              izpgtnj, xnzmk qe jdq xqgknk zj fzlwzrin dwjx nzix qjxnl.
              zr qtm szr, qe jxn izpgtnj ezswtb.
              lqsnq, kqr jq sqrjzygn.
              jbhztj, rnpxnd jq tzmb izpgtnj.
              snligjwq, uwrkszr jq jxn plwrin zrm elwnrm jq lqsnq.
              hnrfqtwq, rnpxnd jq sqrjzygn, zrm elwnrm jq lqsnq
              jbhztj, rnpxnd jq tzmb izpgtnj.
              elwzl tzglnrin, elzriwkizr.
              elwzl vqxr, elzriwkizr.
              hztjxzkzl, knlfzrj jq lqsnq.
              zhlzs, knlfzrj jq sqrjzygn.
              kzspkqr, knlfzrj jq izpgtnj.
              ylnyqlb, knlfzrj jq izpgtnj.
              pnjnl, knlfzrj jq vgtwnj\'k rglkn.
              zr zpqjxnizlb.
              jxlnn sgkwiwzrk.
              zr qeewinl.', 'the tragedy of romeo and juliet
        
              by william shakespeare
        
              dramatis personae
        
              chorus.
            
              escalus, prince of verona.
              paris, a young count, kinsman to the prince.
              montague, heads of two houses at variance with each other.
              capulet, heads of two houses at variance with each other.
              an old man, of the capulet family.
              romeo, son to montague.
              tybalt, nephew to lady capulet.
              mercutio, kinsman to the prince and friend to romeo.
              benvolio, nephew to montague, and friend to romeo
              tybalt, nephew to lady capulet.
              friar laurence, franciscan.
              friar john, franciscan.
              balthasar, servant to romeo.
              abram, servant to montague.
              sampson, servant to capulet.
              gregory, servant to capulet.
              peter, servant to juliet\'s nurse.
              an apothecary.
              three musicians.
              an officer.']
        ];
    }

    /**
     * @param string $fileContent
     * @return SimpleDecryptionAlgorithm
     */
    private function setUpService(string $fileContent) {
        return new SimpleDecryptionAlgorithm($fileContent);
    }

    /**
     * @dataProvider fileData
     * @param string $fileContent
     * @param string $decryptedContent
     */
    public function testDecipher(string $fileContent, string $decryptedContent) {
        $simpleDecryptionAlgorithm = $this->setUpService($fileContent);

        $output = $simpleDecryptionAlgorithm->deCipher();

        $output = preg_replace('/[ \r\n]+/', ' ', $output);
        $decryptedContent = preg_replace('/[ \r\n]+/', ' ', $decryptedContent);

        $this->assertEquals($output, $decryptedContent);
    }

    /**
     * @dataProvider fileData
     * @param string $fileContent
     * @param string $decryptedContent
     */
    public function testWriteToFile(string $fileContent, string $decryptedContent) {
        $simpleDecryptionAlgorithm = $this->setUpService($fileContent);

        $simpleDecryptionAlgorithm->writeToFile();

        $output = preg_replace('/[ \r\n]+/', ' ', file_get_contents($this->fileName));
        $decryptedContent = preg_replace('/[ \r\n]+/', ' ', $decryptedContent);

        $this->assertEquals($output, $decryptedContent);
    }

}