<?php

namespace App\EventSuscriber;


use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;

#[AsEntityListener(Events::postPersist, entity: User::class)]
class WelcomeEmailListenner
{
    public function __construct(private MailerInterface $mailer)
    {
        
    }

    public function postPersist(User $user)
    {
        $email = (new TemplatedEmail())
        ->to(new Address($user->getEmail()))
        ->subject('Welcome to the app')
        ->htmlTemplate('emails/welcome.html.twig')
        ->context([
            'user'=> $user,
        ]);
        
        $this->mailer->send($email);    
    }



}