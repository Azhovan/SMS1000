<?php
declare(strict_types=1);

namespace Sms1000\Client;

use GuzzleHttp\Client as httpClient;
use Illuminate\Support\Collection;

class SmsClient
{
    /**
     * The username of the service
     *
     * @var string
     */
    private $username;

    /**
     * The password of the service
     *
     * @var string
     */
    private $password;

    /**
     * The local used by the service
     *
     * @var string
     */
    private $local;

    /**
     * SmsClient constructor.
     *
     * @param $username
     * @param $password
     * @param $local
     */
    public function __construct($username, $password, $local)
    {
        $this->username = $username;

        $this->password = $password;

        $this->local = $local;
    }


    /**
     * Send http request to the Sms service
     *
     * @param  array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(array $params)
    {
        return (new httpClient())->request(
            'POST',
            config('services.sms.url') . $this->queries($params)
        )->getBody();

    }

    /**
     * Create the http query
     *
     * @param  array $params
     * @return string
     */
    private function queries(array $params)
    {
        $arr = new Collection(
            [
                'username' => $this->username,
                'password' => $this->password,
                $this->local => true
            ]
        );

        $arr = $arr->merge($params);

        return ('?' . http_build_query($arr->all()));
    }

}