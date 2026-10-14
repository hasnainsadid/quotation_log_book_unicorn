<?php
namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            $expire = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

            return (new MailMessage)
                ->subject('Reset Your Password - Unicorn Group')
                ->view('emails.reset-password', [
                    'user'   => $notifiable,
                    'url'    => $url,
                    'expire' => $expire,
                ]);
        });

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            $expire = config('auth.verification.expire', 60);

            return (new MailMessage)
                ->subject('Verify Your Email Address - Unicorn Group')
                ->view('emails.verify-email', [
                    'user'   => $notifiable,
                    'url'    => $url,
                    'expire' => $expire,
                ]);
        });
    }
}
