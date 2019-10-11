<?php

namespace SenderPackage;

class Sender
{
    public $api_key = null;
    public $receiver = null;
    public $sender = null;
    public $carrier = null;
    public $properties = null;

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }
    public function setReceiver(SenderAddress $receiver)
    {
        $this->receiver = $receiver;
    }
    public function setSender(SenderAddress $sender)
    {
        $this->sender = $sender;
    }
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
    }
    public function setProperties($properties = [])
    {
        $this->properties = $properties;
    }

    // public static function makeSending($carrier, SenderAddress $receiver, SenderAddress $sender, $description, $height, $width, $weight, $value)
    // {
    //     return $this->send(
    //         [
    //             'receiver' => $receiver,
    //             'sender' => $sender,
    //             'description'             => $description,
    //             'height'                  => $height,
    //             'carrier'                   => $carrier,
    //             'value'                   => $value,
    //             'weight'                  => $weight,
    //             'width'                   => $width
    //         ]
    //     );
    // }

    public function getParameters()
    {
        return [
            'receiver' => $this->receiver,
            'sender' => $this->sender,
            'description'             => $this->properties->description,
            'height'                  => $this->properties->height,
            'carrier'                   => $this->carrier,
            'value'                   => $this->properties->value,
            'weight'                  => $this->properties->weight,
            'width'                   => $this->properties->width
        ];
    }

    public function send()
    {
        $ch   = curl_init('https://sender-git-staging.wappz.now.sh/send'); // Initialise cURL
        $post = json_encode($this->getParameters()); // Encode the data array into a JSON string
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->api_key,
                'Accept: application/json+v1'
            )
        ); // Inject the token into the header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        $result = curl_exec($ch); // Execute the cURL statement
        curl_close($ch); // Close the cURL connection
        $data = json_decode($result);
        if (!isset($data->errors)) {
            return ['status' => 'ok', 'data' => $data];
        } else {
            return ['status' => 'error', 'error' => $data->errors];
        }

        return ['status' => 'succes'];
    }
}
