<?php
/**
 * Created by Nguyen Van Thiep,
 * User: macosxvn
 * Date: 2019-08-18
 * Time: 15:20
 */
namespace Jetcoder\Test\Instagram;

use Jetcoder\Instagram\Client;
use Jetcoder\Instagram\User;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testGetAuthorizationUrl()
    {
        $clientId = '2c1ade5993514707bbdf11a5dca762d8';
        $redirectUrl = 'https://www.domaine-leos.com/adhh/instagram/confirm';
        $params = [
            'client_id' => $clientId,
            'redirect_uri' => $redirectUrl,
            'response_type' => 'code'
        ];
        $authorizationUrl = 'https://api.instagram.com/oauth/authorize/?' . http_build_query($params);
        $instagramClient = $this->createInstagramClient();
        $this->assertEquals($authorizationUrl, $instagramClient->getAuthorizationUrl());
    }

    public function testGenerateSig()
    {
        $instagramClient = $this->createInstagramClient();
        $endpoint = '/users/self';
        $params = [
            'access_token' => 'fb2e77d.47a0479900504cb3ab4a1f626d174d2d',
        ];
        $sig = 'cbf5a1f41db44412506cb6563a3218b50f45a710c7a8a65a3e9b18315bb338bf';
        $this->assertEquals($sig, $instagramClient->generateSig($endpoint, $params));
    }

    public function testAuthorize()
    {
        $instagramClient = $this->createInstagramClient();
        $instagramClient->setCode('f46b78acebfc4527a458d8bf7532b0e7');
        $user = $instagramClient->authorize();
        $expectedUser = new User([
            "id" => "553033030",
            "username" => "macosxvn",
            "profile_picture" => "https://instagram.fmkc1-2.fna.fbcdn.net/vp/465c06bff9b9407b4a97a96c14dea988/5DF2B4F1/t51.2885-19/44884218_345707102882519_2446069589734326272_n.jpg?_nc_ht=instagram.fmkc1-2.fna.fbcdn.net",
            "full_name" => "Nguyen Van Thiep",
            "bio" => "",
            "website" => "",
            "is_business" => false
        ]);
        $this->assertEquals($expectedUser, $user);
    }

    protected function createInstagramClient()
    {
        $clientId = '2c1ade5993514707bbdf11a5dca762d8';
        $clientSecret = '85d93dbde7b04a529cf61d6cf734864d';
        $redirectUrl = 'https://www.domaine-leos.com/adhh/instagram/confirm';
        return new Client($clientId, $clientSecret, $redirectUrl);
    }
}
