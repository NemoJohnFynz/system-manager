<?php

namespace App\Http\Controllers;

use Google_Client;
use Google\Service\Gmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setApplicationName('Laravel Gmail Integration');
        $this->client->setScopes([Gmail::GMAIL_SEND]);
        $this->client->setAuthConfig(env('PATH_CREDENTIALS'));
        $this->client->setAccessType('offline');
        $this->client->setApprovalPrompt('force');

        // Sử dụng Refresh Token
        if (Session::has('access_token') && isset(Session::get('access_token')['refresh_token'])) {
            $this->client->setAccessToken(Session::get('access_token'));
            if ($this->client->isAccessTokenExpired()) {
                $this->client->fetchAccessTokenWithRefreshToken(Session::get('access_token')['refresh_token']);
                Session::put('access_token', $this->client->getAccessToken());
            }
        } else {
            $token = [
                'refresh_token' => (env('REFRESH_TOKEN')),
                'access_token' => '',
                'expires_in' => 3600,
            ];
            $this->client->setAccessToken($token);
            if ($this->client->isAccessTokenExpired()) {
                $this->client->fetchAccessTokenWithRefreshToken($token['refresh_token']);
                Session::put('access_token', $this->client->getAccessToken());
            }
        }
    }

    public function sendEmail(Request $request)
    {
        if (!$this->client->getAccessToken()) {
            return response()->json(['success' => false, 'message' => 'Vui lòng cấu hình token trước!'], 401);
        }

        $service = new Gmail($this->client);
        $user = 'me';

        $rawMessage = $this->createRawMessage(
            $request->input('to', 'recipient@example.com'), 
            'tienyeuai2200@gmail.com',
            $request->input('subject', 'Test Email từ Laravel'),
            $request->input('message', 'Đây là nội dung email test từ Laravel với Google API.')
        );

        try {
            $message = new \Google\Service\Gmail\Message();
            $message->setRaw($rawMessage);
            $service->users_messages->send($user, $message);
            return response()->json(['success' => true, 'message' => 'Email đã được gửi thành công!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi khi gửi email: ' . $e->getMessage()], 500);
        }
    }

private function createRawMessage($to, $from, $subject, $message)
{
    $mime = "MIME-Version: 1.0\r\n";
    $mime .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $mime .= "To: " . $this->sanitizeEmail($to) . "\r\n";
    $mime .= "From: " . $this->sanitizeEmail($from) . "\r\n";
    $mime .= "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n\r\n";
    $mime .= $message . "\r\n";

    return rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
}

private function sanitizeEmail($email)
{
    return filter_var($email, FILTER_SANITIZE_EMAIL);
}
}