<?php
/**
 * Created by PhpStorm.
 * User: Archi Parikh
 * Date: 7/25/2019
 * Time: 9:11 PM
 */

namespace App\Command;


use App\Cipher\CipherConstant;
use App\Cipher\CipherProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CipherCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:cipher';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Encrypt/Decrypt data.')
            ->addArgument('input-file', InputOption::VALUE_REQUIRED, 'input file path')
            ->addArgument('cipher-mode', InputOption::VALUE_REQUIRED, 'decide cipher mode', CipherConstant::ENCRYPTION)
            ->addOption('cipher-complexity', 'c',InputOption::VALUE_REQUIRED, 'decide cipher complexity', CipherConstant::SIMPLE)

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to encrypt/decrypt data...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('input-file');
        if (! $file || ! realpath($file)) {
            $output->writeln("Input file not found");
            return 1;
        }

        $cipherMode = $input->getArgument('cipher-mode');
        if (!in_array($cipherMode, CipherConstant::CIPHER_MODE)) {
            $output->writeln("CipherProvider mode invalid.");
            return 1;
        }

        $cipherComplexity = $input->getOption('cipher-complexity');
        if (!in_array($cipherComplexity, CipherConstant::CIPHER_COMPLEXITY)) {
            $output->writeln("CipherProvider complexity not supported.");
            return 1;
        }

        $output->writeln("Starting $cipherMode: ".$file);

        try {
            $cipherData = (new CipherProvider($file, $cipherMode, $cipherComplexity))->cipher();
        }
        catch(\Exception $e) {
            $cipherData = $e->getMessage();
        }

        $output->writeln($cipherData);

        return 0;
    }
}