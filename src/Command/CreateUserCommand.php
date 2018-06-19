<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 19/06/2018
 * Time: 14:32
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateUserCommand extends Command
{
    protected function configure()
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'Nom')
//            ->addArgument('lastname', InputArgument::REQUIRED, 'prénom')
//            ->addArgument('password', InputArgument::REQUIRED, 'mot de passe')
//            ->addArgument('email', InputArgument::REQUIRED, 'email')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this
            ->setName('app:create-user')
            ->setDescription('Créer un utilisateur')
            ->setHelp('Cette commande est utilisée pour créer un nouvel utilisateur');

        $output->writeln([
            'Création de users',
            '============'
        ]);

        $output->writeln('username' . $input->getArgument('username'));

        $output->writeln('wahou !');

        $output->write('vous êtes là pour créer un user');
    }
}
