<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;



class ContactNotification

{

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer; 
    }

    public function notify(Contact $contact)
    {
        $email = (new TemplatedEmail())
            ->from("contact@progica.fr")
            ->to($contact->getEmail())
            ->subject("Demande de contact")
            ->htmlTemplate('emails/contact.html.twig')
            ->context(['contact' => $contact]);
            $this->mailer->send($email);
    }

}
// namespace App\Notification;

// use App\Entity\Contact;
// use Symfony\Component\Mime\Email;
// use Symfony\Component\Mailer\MailerInterface;

// class ContactNotification {

//     private $mailer;

//     public function __construct(MailerInterface $mailer)
//     {
//         $this->mailer = $mailer;
//     }

//     public function notify(Contact $contact){

//         $email = (new Email())
//                 ->from('contact@progica.fr')
//                 ->to($contact->getEmail())
//                 ->subject("Demande de contact")
//                 ->text("Je suis {$contact->getFirstname()} et j'aimerais avoir des renseignements sur le gite {$contact->getGite()->getName()}");

//                 $this->mailer->send($email);
//     }
// }

// use App\Entity\Contact;
// use Twig\Environment;

// class ContactNotification {

    
//     /**
//      * @var \Swift_Mailer
//      */
//     private $mailer;

    
//     /**
//      * @var Environnement
//      */
//     private $renderer;


//     public function __construct(\Swift_Mailer $mailer, Environment $renderer){

//         $this->mailer = $mailer;
//         $this->renderer = $renderer;

//     }
    
//     public function notify(Contact $contact){

//         $message = (new \Swift_Message('Gite : ' . $contact->getGite()->getName()))
//              ->setFrom('contact@progica.fr')
//              ->setTo($contact->getEmail())
//              ->setReplyTo($contact->getEmail())
//              ->setBody($this->renderer->render('emails/contact.html.twig', [
//                  'contact' => $contact
//              ]), 'text/html');
             
//         $this->mailer->send($message);

//     }
// }