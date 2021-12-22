<?php
declare(strict_types=1);

namespace App\Application\Middlewares;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CORSMiddleware implements EventSubscriberInterface
{
	public function attachCorsHeaders(ResponseEvent $event): void
	{
		$event->getResponse()->headers->set('Access-Control-Allow-Credentials', 'true');
		$event->getResponse()->headers->set('Access-Control-Allow-Origin', '*');
		$event->getResponse()->headers->set('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
		$event->getResponse()->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, DELETE, PUT');
	}

	public static function getSubscribedEvents(): array
	{
		return [
			ResponseEvent::class => 'attachCorsHeaders',
		];
	}
}
