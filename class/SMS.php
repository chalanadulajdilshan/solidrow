<?php

class SMS
{
    private $user_id;
    private $api_key;
    private $sender_id;
    private $endpoint = "https://api.ozonesender.com/v1/send/";

    public function __construct()
    {
        $this->user_id = "110560";
        $this->api_key = "h93Veu1OQ155vWp";
        $this->sender_id = "Solidrow"; // Default for testing as per docs
    }

    public function sendSMS($recipient, $message)
    {
        $recipient = $this->formatPhoneNumber($recipient);
        
        $params = [
            'user_id' => $this->user_id,
            'api_key' => $this->api_key,
            'sender_id' => $this->sender_id,
            'recipient_contact_no' => $recipient,
            'message' => $message
        ];

        $url = $this->endpoint . "?" . http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ["status" => "error", "message" => "CURL Error: " . $error];
        }

        return json_decode($response, true) ?: ["status" => "success", "raw_response" => $response];
    }

    private function formatPhoneNumber($number)
    {
        // Remove non-numeric characters
        $number = preg_replace('/[^0-9]/', '', $number);

        // If it starts with 0, replace it with 94
        if (strpos($number, '0') === 0) {
            $number = '94' . substr($number, 1);
        }

        // If it starts with 7 and is 9 digits, add 94
        if (strlen($number) == 9 && (strpos($number, '7') === 0)) {
            $number = '94' . $number;
        }

        return $number;
    }
}
