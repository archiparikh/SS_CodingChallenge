<?php
/**
 * Created by PhpStorm.
 * User: archi.parikh
 * Date: 11/17/2017
 * Time: 8:39 PM
 */
namespace App\Cipher;

/**
 * Interface DataConverterInterface
 * @package App\DataConverter
 */
interface CipherProviderInterface {
    /**
     * @param object $file
     * @param string $mode
     * @param string $complexity
     * @return CipherProviderInterface
     */
    public function with($file, string $mode, string $complexity);

    /**
     * @return mixed
     */
    function isSupported();

    /**
     * @return mixed
     */
    function cipher();
}