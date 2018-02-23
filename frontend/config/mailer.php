<?php

return [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',
//                'host'  => 'smtp.mail.yahoo.com',
                'host'      => 'smtp-mail.outlook.com',
                'username' => 'usuario@outlook.com',
                'password' => 'mi-clave',
                'port' => '587',     // 25 o 465 para yahoo - 587 para GMail/outlook
                'encryption' => 'tls',
            ],
        ];