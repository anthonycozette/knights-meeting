<?php

namespace App\Command;

use App\service\ContactService;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use App\Repository\ContactRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendContactCommand extends Command
{
    private $contactRepository;
    private $mailer;
    private $contactService;
    private $userRepository;
    protected static $defaultName = 'app:send-contact';

    public function __construct(ContactRepository $contactRepository, MailerInterface $mailer, ContactService $contactService, UserRepository $userRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->mailer = $mailer;
        $this->contactService = $contactService;
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $toSend = $this->contactRepository->findBy(['isSend' => false]);
        $adress = new Address($this->userRepository->getAdmin()->getEmail(), $this->userRepository->getAdmin()->getPseudo());

        foreach ($toSend as $mail) {
            $email = (new Email())
                ->from($mail->getEmail())
                ->to($adress)
                ->subject('Nouveau message de ' . $mail->getNom())
                ->text($mail->getMessage());
            $this->mailer->send($email);

            $this->contactService->isSend($mail);
        }
        return Command::SUCCESS;
    }
}
