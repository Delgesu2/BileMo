<?php
/**
 * Created by PhpStorm.
 * User: ronsard
 * Date: 16/02/19
 * Time: 17:48
 */

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function save(Client $client)
    {
        $this->_em->persist($client);
        $this->_em->flush();
    }

}