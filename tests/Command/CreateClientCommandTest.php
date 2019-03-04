<?php

namespace App\Tests\Command;

use App\Command\CreateClientCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;


class CreateClientCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:create-client');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'       => $command->getName(),
            'username'      => 'Thomas',
            'email'         => 'monadresse@mail.net',
            'plainPassword' => 'Mot2passe',
            'phoneNumber'   => '123456789'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertContains('Thomas', $output);
        $this->assertContains('monadresse@mail.net', $output);
        $this->assertContains('Mot2passe', $output);
        $this->assertContains('123456789', $output);
    }

}
