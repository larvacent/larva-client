<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Client\Services;

use Larva\Client\LarvaManage;

/**
 * Class User
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class User
{
    /**
     * @var LarvaManage
     */
    protected $client;

    /**
     * User constructor.
     * @param LarvaManage $larvaManage
     */
    public function __construct(LarvaManage $larvaManage)
    {
        $this->client = $larvaManage;
    }

    /**
     * 邮箱注册
     * @param string $email
     * @param string $username
     * @param string $password
     * @return array
     */
    public function emailRegister($email, $username, $password)
    {
        return $this->client->post('/api/v1/user/email-register', ['email' => $email, 'username' => $username, 'password' => $password]);
    }

    /**
     * 手机注册
     * @param string $phone 手机号码
     * @param string $verifyCode 验证码
     * @param string $password 密码
     * @return array
     */
    public function phoneRegister($phone, $verifyCode, $password)
    {
        return $this->client->post('/api/v1/user/phone-register', ['phone' => $phone, 'verifyCode' => $verifyCode, 'password' => $password]);
    }

    /**
     * 手机重置密码
     * @param string $phone 手机号码
     * @param string $verifyCode 验证码
     * @param string $password 密码
     * @return array
     */
    public function phoneResetPassword($phone, $verifyCode, $password)
    {
        return $this->client->post('/api/v1/user/phone-reset-password', ['phone' => $phone, 'verifyCode' => $verifyCode, 'password' => $password]);
    }
}