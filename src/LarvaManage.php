<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Client;

use GuzzleHttp\HandlerStack;
use Larva\Supports\BaseObject;
use Larva\Supports\Traits\HasHttpRequest;

/**
 * Class LarvaManage
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class LarvaManage extends BaseObject
{
    use HasHttpRequest {
        post as public;
        get as public;
        postJSON as public;
        postXML as public;
        request as public;
    }

    /**
     * @var string 令牌
     */
    public $access_token;

    /**
     * @var float
     */
    public $timeout = 5.0;

    /**
     * @var string
     */
    public $endpoint = '';

    /**
     * 获取基础路径
     * @return string
     */
    public function getBaseUri()
    {
        return $this->endpoint;
    }

    /**
     * 设置基础路径
     * @param string $baseUri
     * @return $this
     */
    public function setBaseUri($baseUri)
    {
        $this->endpoint = $baseUri;
        return $this;
    }

    /**
     * 获取基础路径
     * @param array $httpOptions
     * @return string
     */
    public function setHttpOptions($httpOptions)
    {
        $this->httpOptions = $httpOptions;
        return $this;
    }

    /**
     * 获取 access_token
     * @return string
     */
    protected function getAccessToken()
    {
        if (!$this->access_token) {
            $res = $this->post('oauth/personal-access-tokens', ['name' => 'Larva Client']);

        }
        return $this->access_token;
    }

    /**
     * @return HandlerStack
     */
    public function getHandlerStack()
    {
        $stack = HandlerStack::create();
        $middleware = new LarvaStack([
            'access_token' => $this->access_token,
        ]);
        $stack->push($middleware);
        return $stack;
    }
}