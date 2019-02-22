<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 16/02/19
 * Time: 17:42
 */

namespace App\Command;

use App\Entity\Client;
use App\Repository\ClientRepository;
use JMS\Serializer\Tests\Fixtures\Input;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateClientCommand extends Command
{
    /**
     * @var ClientRepository
     */
    private $repository;

    protected static $defaultName = 'app:create-client';

    /**
     * CreateClientCommand constructor.
     *
     * @param ClientRepository $repository
     */
    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct();
    }

    protected function configure()
    {
        $this

            // command name (after "bin/console")
            ->setName('app:create-client')

            // shown while running "php bin/console list"
            ->setDescription('Creates a new client.')

            // full description when running the command with "--help" option
            ->setHelp('Cette commande permet de créer un nouveau Client.')

            ->addArgument('username', InputArgument::REQUIRED, 'Enter a name')
            ->addArgument('email', InputArgument::REQUIRED, 'Enter email address')
            ->addArgument('plainPassword', InputArgument::REQUIRED, 'Chose a password')
            ->addArgument('phoneNumber',InputArgument::REQUIRED, 'A phone number')
            ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     *
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Client Creator',
            '=============',
            ''
        ]);

        $output->writeln('Vous allez créer un nouveau Client.');

        $output->writeln('Nom : ' .$input->getArgument('username'));

        $output->writeln('Adresse courriel : ' .$input->getArgument('email'));

        $output->writeln('Mot de passe : ' .$input->getArgument('plainPassword'));

        $output->writeln('Numéro de téléphone : ' .$input->getArgument('phoneNumber'));

        // Instanciation Entity
        $client = new Client();

        $client->setUsername($input->getArgument('username'));
        $client->setEmail($input->getArgument('email'));
        $client->setPlainPassword($input->getArgument('plainPassword'));
        $client->setPhoneNumber($input->getArgument('phoneNumber'));

        // Persisting Entity
        $this->repository->save($client);

        $output->writeln('Client créé. Bravo.');

    }

}