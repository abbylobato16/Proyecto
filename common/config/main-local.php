<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ProEst',
            'username' => 'root',
            'password' => '123456789',
            'charset' => 'utf8',
        ],
        'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                //'viewPath' => '@common/mail',
                'useFileTransport' => false,
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host'=>'smtp.gmail.com',
                    'username'=>'Sisgescomprassoftware123@gmail.com',
                    'password'=>'resetpassword12345',
                    'port'=>'587',
                    'encryption'=>'tls',
                    'streamOptions' => [ 
                    'ssl' => [ 
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        ],
                    ]
                ],
            ],
    ],
];
