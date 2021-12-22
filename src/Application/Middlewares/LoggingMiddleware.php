<?php
declare(strict_types=1);

namespace App\Application\Middlewares;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LoggingMiddleware implements EventSubscriberInterface
{
	private LoggerInterface $logger;

	/**
	 * LoggingMiddleware constructor.
	 *
	 * @param \Psr\Log\LoggerInterface $logger
	 */
	public function __construct(\Psr\Log\LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	public function onRequest(RequestEvent $event): void
	{
		$this->logger->info(sprintf(
			'<-- Incoming request to %s (query: %s; body: %s; headers: %s)',
			$event->getRequest()->getUri(),
			$event->getRequest()->getQueryString(),
			$event->getRequest()->getContent(),
			var_export($event->getRequest()->headers->all(), true)
		));
	}

	public function onResponse(ResponseEvent $event): void
	{
		$this->logger->info(sprintf(
			'--> Response (HTTP status code: %d): %s, headers: %s',
			$event->getResponse()->getStatusCode(),
			$event->getResponse()->getContent(),
			var_export($event->getResponse()->headers->all(), true),
		));
	}

	public static function getSubscribedEvents(): array
	{
		return [
			KernelEvents::REQUEST => 'onRequest',
			KernelEvents::RESPONSE => 'onResponse',
		];
	}
}
