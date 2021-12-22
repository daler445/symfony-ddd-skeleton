<?php
declare(strict_types=1);

namespace App\Application\Actions;

use App\Kernel;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

abstract class Action extends Kernel implements LoggerAwareInterface
{
	/**
	 * @var \Symfony\Component\HttpFoundation\Request
	 */
	protected Request $request;

	/**
	 * @var \Symfony\Component\HttpFoundation\Response
	 */
	protected Response $response;

	/**
	 * @var \Psr\Log\LoggerInterface
	 */
	protected LoggerInterface $logger;

	/**
	 * @var \Doctrine\Persistence\ManagerRegistry
	 */
	protected ManagerRegistry $doctrine;

	/**
	 * Action constructor.
	 *
	 * @param \Psr\Log\LoggerInterface              $logger
	 * @param \Doctrine\Persistence\ManagerRegistry $doctrine
	 */
	public function __construct(LoggerInterface $logger, ManagerRegistry $doctrine)
	{
		$this->logger = $logger;
		$this->doctrine = $doctrine;
	}

	/**
	 * @param \Symfony\Component\HttpFoundation\Request  $request
	 * @param \Symfony\Component\HttpFoundation\Response $response
	 */
	public function __invoke(Request $request, Response $response) {
		$this->request = $request;
		$this->response = $response;
	}

	public function setLogger(LoggerInterface $logger): void {
		$this->logger = $logger;
	}


	abstract public function action(): Response;

	protected function respondWithData($data = null, int $statusCode = 200): Response
	{
		$payload = new ActionPayload($statusCode, $data);

		return $this->respond($payload);
	}

	protected function respond(ActionPayload $payload): Response
	{
		$response = new Response();
		try {
			$json = json_encode($payload, JSON_THROW_ON_ERROR);
			$response = $response->setContent($json);

			$response = $response->setStatusCode($payload->getStatusCode());
			$response->headers->set('Content-Type', 'application/json');
			return $response;
		} catch (\JsonException $e) {
			$response = new Response('{"ERROR":"INTERNAL CORE ERROR"}');
			$response->setStatusCode(500);
			return $response;
		}
	}
}
