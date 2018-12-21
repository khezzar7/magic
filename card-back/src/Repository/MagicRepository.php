<?php

namespace App\Repository;

use App\Entity\Magic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Magic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Magic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Magic[]    findAll()
 * @method Magic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MagicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Magic::class);
    }

    public function findAllCard()
    {
      $connection = $this-> getEntityManager()->getConnection();
      $sql=
      'SELECT * FROM magic';
      $query=$connection->prepare($sql);
      $query->execute();
      return  $query->fetchAll();
    }
}
