<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            //->setTextBody($this->body)
            ->setHtmlBody($this->body)
            ->send();
    }

    public function contact($email)
    {

//            return Yii::$app->mailer->compose()
//                ->setTo($email)
//                ->setFrom([$this->email => $this->name])
//                ->setSubject($this->subject)
//                ->setHtmlBody('<b>HTML content</b>')
//                ->setTextBody($this->body)
//                ->setHtmlBody($this->body)
//                ->send();

            //envío el correo

            $from = $this->name . "<info@blonder413.com>";
            $subject = "Contacto desde mi Web";
            $body = "
                    <html>
                    <head>
                    <body>
                        <strong>Asunto</strong>:<br /> " . $this->subject ."
                        <br /><br />
                        <strong>Nombre</strong>:<br /> " . $this->name ."
                        <br /><br />
                        <strong>E-mail</strong>:<br /> " . $this->email . "
                        <br /><br />
                        <strong>Mensaje</strong>:<br /> " . $this->body . "
                    </body>
                    </head>
                    <html>
                    ";

            //personalizar el mensaje
            $sheader="From:".$from."\nReply-To:".$from."\n";
            $sheader=$sheader."X-Mailer:PHP/".phpversion()."\n";
            $sheader=$sheader."Mime-Version: 1.0\n";
            $sheader=$sheader."Content-Type: text/html";

            mail(Yii::$app->params['supportEmail'], $subject, $body, $sheader);

            return true;

    }
}
