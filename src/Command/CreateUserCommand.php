<?php
/**
 * Created by PhpStorm.
 * User: Maxime GINDRE
 * Date: 19/06/2018
 * Time: 14:32
 */

namespace App\Command;

use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

final class CreateUserCommand extends Command
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $passwordFactory;

    /**
     * CreateUserCommand constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param EncoderFactoryInterface $passwordFactory
     */
    public function __construct(UserRepositoryInterface $userRepository, EncoderFactoryInterface $passwordFactory)
    {
        $this->userRepository = $userRepository;
        $this->passwordFactory = $passwordFactory;
        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setName('app:create-user')
            ->setDescription('Créer un utilisateur')
            ->setHelp('Cette commande est utilisée pour créer un nouvel utilisateur')

            ->addArgument('username', InputArgument::REQUIRED, 'Nom')
            ->addArgument('lastname', InputArgument::REQUIRED, 'prénom')
            ->addArgument('password', InputArgument::REQUIRED, 'mot de passe')
            ->addArgument('email', InputArgument::REQUIRED, 'email')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $encoder = $this->passwordFactory->getEncoder(User::class);

        $callable = \Closure::fromCallable([$encoder, 'encodePassword']);

        $user = new User(
            $input->getArgument('email'),
           $input->getArgument('username'),
           $input->getArgument('lastname'),
            $input->getArgument('password'),
            $callable,
            new \DateTime(),
            null,
            true,
            'ROLE_ADMIN',
            $input->getArgument('username') . '-' . $input->getArgument('lastname')
        );

        $this->userRepository->save($user);

        $output->writeln('Admin Created');
    }
}
