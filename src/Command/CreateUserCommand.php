<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    private $entitiManagerInterface;
    private $encoder;
    protected static $defaultName = 'app:create-user';

    public function __construct(EntityManagerInterface $entitiManagerInterface, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManagerInterface = $entitiManagerInterface;
        $this->encoder = $encoder;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('userpseudo', InputArgument::REQUIRED, 'the userpseudo of the user.')
            ->addArgument('password', InputArgument::REQUIRED, 'the password of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User();

        $user->setEmail($input->getArgument('userpseudo'));
        $password = $this->encoder->encodePassword($user, $input->getArgument('password'));
        $user->setPassword($password);

        $user->setRoles(['ROLE_ADMIN'])
            ->setpseudo('')
            ->setNom('');

        $this->entityManagerInterface->persist($user);
        $this->entityManagerInterface->flush();

        return Command::SUCCESS;
    }

}
