<?php

namespace App\Repository;

use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Room::class);
    }
    public function RoomFinder($begindate, $enddate)
    {
        $query = $this->_em->createQueryBuilder();

        $subquery = $this->_em->createQueryBuilder()
            ->select('identity(booking.room)')
            ->from(Booking::class, 'booking')
            ->where('booking.start_time BETWEEN :from AND :to')
            ->orWhere('booking.end_time BETWEEN :from AND :to')
            ->orWhere(':from BETWEEN booking.start_time and booking.end_time ')
            ->orderBy('booking.start_time', 'ASC')
            ->setParameters(['from' => $begindate, 'to' => $enddate])
            ->getDQL();


        return $query->select('room')
            ->from(Room::class, 'room')
            ->where($query->expr()->notIn('room.id', $subquery))
            ->getQuery()
            ->setParameters(['from' => $begindate, 'to' => $enddate])->getResult();
    }
    // /**
    //  * @return Room[] Returns an array of Room objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Room
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
