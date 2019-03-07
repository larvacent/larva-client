<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Client;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Facades\Cache;
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
     * @var float
     */
    public $timeout = 5.0;

    /**
     * @var string
     */
    public $client_id;

    /**
     * @var string
     */
    public $client_secret;

    /**
     * @var string
     */
    public $endpoint = '';

    /**
     * @var string
     */
    public $personal_access_token;

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
     * 获取客户端授权令牌
     * @return string
     */
    public function getAccessToken()
    {
        if (empty($this->personal_access_token)) {
            return $this->personal_access_token;
        } else {
            return $this->getClientAccessToken();
        }
    }

    /**
     * 获取客户端授权令牌
     * @return string
     */
    public function getClientAccessToken()
    {
        if (($accessInfo = Cache::get(__METHOD__)) == null) {
            $http = new Client([
                'base_uri' => $this->getBaseUri(),
                'timeout' => $this->timeout,
            ]);
            $response = $http->post('/oauth/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'scope' => '',
                ],
            ]);
            $accessInfo = json_decode((string)$response->getBody(), true);
            $accessInfo['expires_in'] = now()->addMinutes($accessInfo['expires_in'] / 60 - 600);
            Cache::set(__METHOD__, $accessInfo, $accessInfo['expires_in']);
        }
        return $accessInfo['access_token'];
    }

    /**
     * @return HandlerStack
     */
    public function getHandlerStack()
    {
        $stack = HandlerStack::create();
        $middleware = new LarvaStack([
            'access_token' => $this->getAccessToken(),
        ]);
        $stack->push($middleware);
        return $stack;
    }

    /**
     * Make a http request.
     *
     * @param string $method
     * @param string $endpoint
     * @param array $options http://docs.guzzlephp.org/en/latest/request-options.html
     * @return mixed
     */
    public function request($method, $endpoint, $options = [])
    {
        $options['headers']['Accept'] = 'application/json';
        return $this->unwrapResponse($this->getHttpClient()->{$method}($endpoint, $options));
    }
}