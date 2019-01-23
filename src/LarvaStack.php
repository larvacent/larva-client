<?php
/**
 * @copyright Copyright (c) 2018 Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Client;

use Psr\Http\Message\RequestInterface;

/**
 * Class LarvaStack
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class LarvaStack
{
    /** @var array Configuration settings */
    private $config = [
        'access_token' => '',
    ];


    public function __construct($config)
    {
        if (!empty($config)) {
            foreach ($config as $key => $value) {
                $this->config[$key] = $value;
            }
        }
    }

    /**
     * Called when the middleware is handled.
     *
     * @param callable $handler
     *
     * @return \Closure
     */
    public function __invoke(callable $handler)
    {
        return function ($request, array $options) use ($handler) {
            $request = $this->onBefore($request);
            return $handler($request, $options);
        };
    }

    /**
     * 请求前调用
     * @param RequestInterface $request
     * @return RequestInterface
     */
    private function onBefore(RequestInterface $request)
    {
        $token = 'Bearer ' . $this->config['access_token'];
        return $request->withAddedHeader('Authorization', $token);
    }
}