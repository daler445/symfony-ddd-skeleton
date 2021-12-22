<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistent\Doctrine\Product;

use App\Domain\Product\Product;
use App\Domain\Product\Repository\ProductRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class InDatabaseProductRepository extends ServiceEntityRepository implements ProductRepository
{
	/**
	 * ProductRepository constructor.
	 *
	 * @param \Doctrine\Persistence\ManagerRegistry $registry
	 */
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Product::class);
	}
}
