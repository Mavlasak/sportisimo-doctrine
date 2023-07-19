<?php declare(strict_types=1);

namespace App\Model\Trademark;

use App\Entity\Trademark;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Nettrine\ORM\EntityManagerDecorator;

final class TrademarkRepository extends EntityRepository
{

    public function __construct(
        EntityManagerDecorator $em,
    ) {
        parent::__construct($em, new ClassMetadata(Trademark::class));
    }

    public function save(Trademark $trademark): void
    {
        $em = $this->getEntityManager();
        $em->persist($trademark);
        $em->flush();
    }

    public function exist(string $name): bool
    {
        return $this->findOneBy(['name' => $name]) !== null;
    }

    public function getAllOrderByName(int $limit, int $offset, bool $desc): array
    {
        $qb =  $this->createQueryBuilder('t')
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        if ($desc) {
            $qb->orderBy('t.name', Criteria::DESC);    
        } else {
            $qb->orderBy('t.name');
        }
        
        return $qb->getQuery()->getResult();
    }

    public function delete(Trademark $trademark): void
    {
        $em = $this->getEntityManager();
        $em->remove($trademark);
        $em->flush();
    }

    public function getAllCount(): int
    {
        return $this->createQueryBuilder('t')
            ->select('COUNT(t.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
