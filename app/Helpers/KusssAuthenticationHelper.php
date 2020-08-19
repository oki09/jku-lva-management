<?php


namespace App\Helpers;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;

class KusssAuthenticationHelper
{
    static function getSessionId()
    {
        $client = new Client();
        try {
            $req = new Request(
                'GET',
                env('KUSSS_INDEX')
            );
            $res = $client->send($req);

            if ($res->getStatusCode() == 200) {
                return explode(';', $res->getHeader('Set-Cookie')[0])[0];
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

    static function authenticate($sessionId, $studentId, $password)
    {
        $client = new Client();
        $headers = [
            'Cookie' => $sessionId,
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $body = [
            'form_params' => [
                'j_username' => $studentId,
                'j_password' => $password
            ]
        ];

        try {
            $req = new Request(
                'POST',
                env('KUSSS_LOGIN'),
                $headers,
                json_encode($body)
            );
            $res = $client->send($req);
            if ($res->getStatusCode() == 200) {
                dd($res->getBody()->getContents());
            }
            return [];
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
