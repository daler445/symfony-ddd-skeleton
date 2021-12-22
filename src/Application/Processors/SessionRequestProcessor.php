<?php
declare(strict_types=1);

namespace App\Application\Processors;

use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionRequestProcessor
{
	private RequestStack $requestStack;

	/**
	 * SessionRequestProcessor constructor.
	 *
	 * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
	 */
	public function __construct(\Symfony\Component\HttpFoundation\RequestStack $requestStack)
	{
		$this->requestStack = $requestStack;
	}

	public function __invoke(array $record)
	{
		$request = $this->requestStack->getCurrentRequest();

		if ($request) {
			global $processor;
			$record['extra']['pid'] = $processor->getUid();

			$record['extra']['host'] = $request->getHost();
			$record['extra']['port'] = $request->getPort();
			$record['extra']['url'] = $request->getRequestUri();
			$record['extra']['query'] = $request->getQueryString();
			$record['extra']['method'] = $request->getMethod();
			$record['extra']['ipv4'] = $request->getClientIp();
			$record['extra']['timestamp'] = time();
		}

		$info = $this->findFile();
		$record['extra']['file'] = $info['file'];
		$record['extra']['line'] = $info['line'];

		return $record;
	}

	private function findFile(): array {
		$debug = debug_backtrace();
		return [
			'file' => $debug[3] ? $debug[3]['file'] : '',
			'line' => $debug[3] ? $debug[3]['line'] : ''
		];
	}
}
