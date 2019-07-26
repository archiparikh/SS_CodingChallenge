<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/25/2019
 * Time: 10:40 PM
 */

namespace Tests\Cipher;


use App\Cipher\CipherConstant;
use App\Cipher\Encryption\SimpleEncryptionAlgorithm;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class SimpleEncryptionAlgorithmTest extends TestCase
{
    /**
     * @var string
     */
    private $fileName = CipherConstant::SIMPLE_ENCRYPTED_FILE_PATH;

    public function fileData() {
        return [
            ['', ''],
            ['abcdefghijklmnopqrstuvwxyz', 'zhimneyxwvutsrqpolkjgfdcba'],
            ['THE TRAGEDY OF ROMEO AND JULIET
        
              by William Shakespeare
        
              Dramatis Personae
        
              Chorus.
            
              Escalus, Prince of Verona.
              Paris, a young Count, kinsman to the Prince.
              Montague, heads of two houses at variance with each other.
              Capulet, heads of two houses at variance with each other.
              An old Man, of the Capulet family.
              Romeo, son to Montague.
              Tybalt, nephew to Lady Capulet.
              Mercutio, kinsman to the Prince and friend to Romeo.
              Benvolio, nephew to Montague, and friend to Romeo
              Tybalt, nephew to Lady Capulet.
              Friar Laurence, Franciscan.
              Friar John, Franciscan.
              Balthasar, servant to Romeo.
              Abram, servant to Montague.
              Sampson, servant to Capulet.
              Gregory, servant to Capulet.
              Peter, servant to Juliet\'s nurse.
              An Apothecary.
              Three Musicians.
              An Officer.', 'jxn jlzynmb qe lqsnq zrm vgtwnj

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
              zr qeewinl.']
        ];
    }

    /**
     * @param string $fileContent
     * @return SimpleEncryptionAlgorithm
     */
    private function setUpService(string $fileContent) {
        return new SimpleEncryptionAlgorithm($fileContent);
    }

    /**
     * @dataProvider fileData
     * @param string $fileContent
     * @param string $encryptedContent
     */
    public function testEncipher(string $fileContent, string $encryptedContent) {
        $simpleEncryptionAlgorithm = $this->setUpService($fileContent);

        $output = $simpleEncryptionAlgorithm->enCipher();

        $output = preg_replace('/[ \r\n]+/', ' ', $output);
        $encryptedContent = preg_replace('/[ \r\n]+/', ' ', $encryptedContent);

        $this->assertEquals($output, $encryptedContent);
    }

    /**
     * @dataProvider fileData
     * @param string $fileContent
     * @param string $encryptedContent
     */
    public function testWriteToFile(string $fileContent, string $encryptedContent) {
        $simpleEncryptionAlgorithm = $this->setUpService($fileContent);

        $simpleEncryptionAlgorithm->writeToFile();

        $output = preg_replace('/[ \r\n]+/', ' ', file_get_contents($this->fileName));
        $encryptedContent = preg_replace('/[ \r\n]+/', ' ', $encryptedContent);

        $this->assertEquals($output, $encryptedContent);
    }

}