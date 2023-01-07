<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class UserCreated extends Notification
{
    use Queueable;

    private $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Invitation à rejoindre l'application Beewatch de l'association Tamboureine")
            ->line("Vous recevez cet email, car vous avez été invité à rejoindre l'application Beewatch de l'association Tamboureine. En cliquant sur le bouton ci-dessous, vous pourrez activer votre compte.")
            ->line("Votre mot de passe pour votre première connexion : ")
            ->line(new HtmlString("<center><b>" . $this->password . "</b></center>"))
            ->action('Activer mon compte', url('/login'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}