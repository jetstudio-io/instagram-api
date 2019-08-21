<?php
declare(strict_types=1);
/**
 * Created by Nguyen Van Thiep,
 * User: macosxvn
 * Date: 2019-08-18
 * Time: 13:42
 */

namespace Jetcoder\Instagram;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;

class Client
{
    const INSTAGRAM_DOMAIN = 'https://api.instagram.com';
    const API_VERSION = 'v1';

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $redirectUrl;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * Client constructor.
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUrl
     */
    public function __construct(string $clientId, string $clientSecret, string $redirectUrl)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUrl = $redirectUrl;

        $this->httpClient = new HttpClient([
            'base_uri' => self::INSTAGRAM_DOMAIN . '/' . self::API_VERSION . '/'
        ]);
    }

    public function getAuthorizationUrl(): string
    {
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'response_type' => 'code'
        ];

        return self::INSTAGRAM_DOMAIN . '/oauth/authorize/?' . http_build_query($params);
    }

    public function authorize(): ?User
    {
        if (!$this->code) {
            return null;
        }

        $endpoint = '/oauth/access_token';
        $params = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->redirectUrl,
            'code' => $this->code
        ];

        $data = $this->post($endpoint, $params);

        if (!empty($data)) {
            $this->accessToken = $data['access_token'];
            return new User($data['user']);
        } else {
            return null;
        }
    }

    public function generateSig(string $endpoint, array $params): string
    {
        $sig = $endpoint;
        ksort($params);
        foreach ($params as $key => $val) {
            $sig .= "|{$key}={$val}";
        }
        return hash_hmac('sha256', $sig, $this->clientSecret, false);
    }

    public function getRecentMedia($limit = 3, $maxId = 0): ?array
    {
        if (!$this->accessToken) {
            return null;
        }
        $endpoint = 'users/self/media/recent';
        $params = [
            'access_token' => $this->accessToken,
            'limit' => $limit
        ];
        if ($maxId) {
            $params['max_id'] = $maxId;
        }
        $data = $this->get($endpoint, $params);
        if (!empty($data) && $data['meta']['code'] == 200) {
            $posts = [];
            foreach ($data['data'] as $posData) {
                $posts[] = PostFactory::createInstanceByData($posData);
            }
            $return = [
                'posts' => $posts,
                'next_max_id' => $data['next_max_id'] ?? 0
            ];
        } else {
            return null;
        }
    }

    public function me(): ?User
    {
        if (!$this->accessToken) {
            return null;
        }
        $endpoint = 'users/self';
        $params = [
            'access_token' => $this->accessToken
        ];
        $data = $this->get($endpoint, $params);
        if (!empty($data)) {
            return new User($data['data']);
        } else {
            return null;
        }
    }

    protected function get($endpoint, $params): ?array
    {
        $sig = $this->generateSig($endpoint, $params);
        $params['sig'] = $sig;
        try {
            $response = $this->httpClient->get($endpoint, ['query' => $params]);
            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }
        } catch (ClientException $e) {
            error_log($e->getMessage(), 0);
        }
        return null;
    }

    protected function post($endpoint, $params): ?array
    {
        $sig = $this->generateSig($endpoint, $params);
        $params['sig'] = $sig;
        try {
            $response = $this->httpClient->post($endpoint, ['form_params' => $params]);
            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }
        } catch (ClientException $e) {
            error_log($e->getMessage(), 0);
        }
        return null;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return Client
     */
    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return Client
     */
    public function setClientSecret(string $clientSecret): self
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    /**
     * @param string $redirectUrl
     * @return Client
     */
    public function setRedirectUrl(string $redirectUrl): self
    {
        $this->redirectUrl = $redirectUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Client
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @return Client
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }
}
