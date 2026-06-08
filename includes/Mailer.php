<?php

class Mailer {
    private $host;
    private $port;
    private $user;
    private $pass;
    private $secure;

    public function __construct($host, $port, $user, $pass, $secure = 'ssl') {
        $this->host = $host;
        $this->port = (int)$port;
        $this->user = $user;
        $this->pass = $pass;
        $this->secure = strtolower($secure);
    }

    public function send($to, $subject, $body, $headers = []) {
        $transport = ($this->secure === 'ssl') ? 'ssl://' : '';
        $socket = @fsockopen($transport . $this->host, $this->port, $errno, $errstr, 15);
        
        if (!$socket) {
            throw new Exception("Connection failed: $errstr ($errno)");
        }

        $this->readResponse($socket, 220);
        $this->writeCommand($socket, "EHLO " . ($_SERVER['SERVER_NAME'] ?: 'localhost'), 250);

        if ($this->secure === 'tls') {
            $this->writeCommand($socket, "STARTTLS", 220);
            if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                throw new Exception("TLS negotiation failed");
            }
            $this->writeCommand($socket, "EHLO " . ($_SERVER['SERVER_NAME'] ?: 'localhost'), 250);
        }

        if (!empty($this->user) && !empty($this->pass)) {
            $this->writeCommand($socket, "AUTH LOGIN", 334);
            $this->writeCommand($socket, base64_encode($this->user), 334);
            $this->writeCommand($socket, base64_encode($this->pass), 235);
        }

        $from = $this->user ?: 'portfolio@abhiuday.com';
        $this->writeCommand($socket, "MAIL FROM: <$from>", 250);
        $this->writeCommand($socket, "RCPT TO: <$to>", 250);
        $this->writeCommand($socket, "DATA", 354);

        $defaultHeaders = [
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/html; charset=utf-8',
            'From' => 'Abhiuday Pratap Singh <' . $from . '>',
            'To' => $to,
            'Subject' => '=?UTF-8?B?' . base64_encode($subject) . '?=',
            'Date' => date('r')
        ];
        
        $mergedHeaders = array_merge($defaultHeaders, $headers);
        $headerStr = "";
        foreach ($mergedHeaders as $k => $v) {
            $headerStr .= "$k: $v\r\n";
        }

        // Send headers and body
        fwrite($socket, $headerStr . "\r\n" . $body . "\r\n.\r\n");
        $this->readResponse($socket, 250);
        
        $this->writeCommand($socket, "QUIT", 221);
        fclose($socket);
        return true;
    }

    private function writeCommand($socket, $cmd, $expectedCode) {
        fwrite($socket, $cmd . "\r\n");
        $this->readResponse($socket, $expectedCode);
    }

    private function readResponse($socket, $expectedCode) {
        $response = "";
        while ($str = fgets($socket, 515)) {
            $response .= $str;
            if (substr($str, 3, 1) === " ") {
                break;
            }
        }
        $code = (int)substr($response, 0, 3);
        if ($code !== $expectedCode) {
            throw new Exception("SMTP error: " . trim($response));
        }
    }
}
