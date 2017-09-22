<?php

return [

    'twilio' => [

        'default' => 'twilio',

        'connections' => [

            'twilio' => [

                /*
                |--------------------------------------------------------------------------
                | SID
                |--------------------------------------------------------------------------
                |
                | Your Twilio Account SID #
                |
                */

                'sid' => getenv('TWILIO_SID') ?: 'ACf72a487e4ba87dc4038c2cc85a57e00f',

                /*
                |--------------------------------------------------------------------------
                | Access Token
                |--------------------------------------------------------------------------
                |
                | Access token that can be found in your Twilio dashboard
                |
                */

                'token' => getenv('TWILIO_TOKEN') ?: '176d172fb3963383dcf878d2a35b7fd9',

                /*
                |--------------------------------------------------------------------------
                | From Number
                |--------------------------------------------------------------------------
                |
                | The Phone number registered with Twilio that your SMS & Calls will come from
                |
                */

                'from' => getenv('TWILIO_FROM') ?: '+15402355212',

                /*
                |--------------------------------------------------------------------------
                | Verify Twilio's SSL Certificates
                |--------------------------------------------------------------------------
                |
                | Allows the client to bypass verifying Twilio's SSL certificates.
                | It is STRONGLY advised to leave this set to true for production environments.
                |
                */

                'ssl_verify' => true,
            ],
        ],
    ],
];
