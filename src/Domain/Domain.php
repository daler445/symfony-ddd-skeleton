<?php
declare(strict_types=1);

namespace App\Domain;

use App\Kernel;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

abstract class Domain extends Kernel implements LoggerAwareInterface
{
	/**
	 * @var \Psr\Log\LoggerInterface
	 */
	protected LoggerInterface $logger;

	/**
	 * @var \Doctrine\Persistence\ManagerRegistry
	 */
	protected ManagerRegistry $doctrine;

	/**
	 * Domain constructor.
	 *
	 * @param \Doctrine\Persistence\ManagerRegistry $doctrine
	 */
	public function __construct(\Doctrine\Persistence\ManagerRegistry $doctrine)
	{
		$this->doctrine = $doctrine;
	}

	/**
	 * @param \Psr\Log\LoggerInterface $logger
	 */
	public function setLogger(LoggerInterface $logger): void {
		$this->logger = $logger;
	}
}
