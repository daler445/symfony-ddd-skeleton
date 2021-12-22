<?php
declare(strict_types=1);

namespace App\Application\Actions\Ping;

use Symfony\Component\HttpFoundation\Response;
use App\Application\Actions\Action;

class Ping extends Action
{
	public function action(): Response
	{
		$this->logger->info('Ping - Pong');

		return $this->respondWithData(['ping' => 'pong']);
	}
}
