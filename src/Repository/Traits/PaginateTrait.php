<?php

namespace App\Repository\Traits;

trait PaginateTrait{
    public function findAllWithPagination($page, $limit): array
    {
        $qb = $this->createQueryBuilder('b')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }
}