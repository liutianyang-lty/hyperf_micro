<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\Guzzle;

use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RetryMiddleware implements MiddlewareInterface
{
    protected $retries = 1;

    protected $delay = 0;

    public function __construct(int $retries = 1, int $delay = 0)
    {
        $this->retries = $retries;
        $this->delay = $delay;
    }

    public function getMiddleware(): callable
    {
        return Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null) {
            if (! $this->isOk($response) && $retries < $this->retries) {
                return true;
            }
            return false;
        }, function () {
            return $this->delay;
        });
    }

    /**
     * Check the response status is correct.
     */
    protected function isOk(?ResponseInterface $response): bool
    {
        return $response && $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
    }
}
