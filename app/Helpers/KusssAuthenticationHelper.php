<?php


namespace App\Helpers;


use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;

class KusssAuthenticationHelper
{
    static function getCookie()
    {
        $client = new Client();
        try {
            $req = new Request(
                'GET',
                env('KUSSS_INDEX')
            );
            $res = $client->send($req);
            if ($res->getStatusCode() == 200) {
                return $res->getHeader('Set-Cookie')[0];
            }
            return [];
        } catch (ClientException $e) {
            $code = $e->getResponse()->getStatusCode();
            abort($code);
        } catch (ServerException $e) {
            abort(500);
        } catch (ConnectException $e) {
            abort(500);
        }
    }


    static function authenticate($cookie, $studentId, $password)
    {
        $jar = CookieJar::fromArray([
            'myCookie' => $cookie
        ], env('KUSSS_HOST'));
        $client = new Client();
        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:79.0) Gecko/20100101 Firefox/79.0',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'text/html,application/xhtml+xml,application/xml',
            'Accept-Language' => 'en,de',
            'Accept-Encoding' => 'gzip'
        ];
        try {
            $res = $client->post(
                env('KUSSS_LOGIN'), [
                    'headers' => $headers,
                    'cookies' => $jar,
                    'form_params' => [
                        'j_username' => $studentId,
                        'j_password' => $password,
                        'log' => 1
                    ]
                ]
            );
            $dom = new \DOMDocument();
            // load html as traversable XML object
            $dom->loadHTML(trim($res->getBody()->getContents()), LIBXML_NOERROR);
            $xpath = new \DOMXpath($dom);
            // execute a xpath query similar to this jquery ('#login_out').find('a').attr('href')
            $logoutElement = $xpath->query('//li[@id="login_out"]/a[@href="logout.action"]');
            if($logoutElement->length > 0) return 1;
            return 0;
        } catch (ClientException $e) {
            $code = $e->getResponse()->getStatusCode();
            $path = (string)$e->getRequest()->getUri()->getPath();
            abort($code, $path);
        } catch (ServerException $e) {
            abort(500);
        } catch (ConnectException $e) {
            abort(500);
        }
    }
}
