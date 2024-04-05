<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Mail;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            $mailMessage = Mail::latest()->first();

            return (new MailMessage)

            // ↓↓ここを編集する！！Mailモデルから代入する？
                ->subject($mailMessage->subject ?? 'Verify Email Address')//←←件名（ex.メールアドレス確認）
                ->line($mailMessage->line1 ?? 'Click the button below to verify your email address.')//←本文（ex.下のボタンをクリックしてメールアドレスを確認してください）
                ->action($mailMessage->action ?? 'Verify Email Address', $url)//←メールの確認リンク（ボタンに表示される文言　ex.メールアドレスの確認）
                ->line($mailMessage->line2 ?? 'Thank you for using our application!')//(私達のアプリケーションをご利用いただき、ありがとうございます。)
                ->line($mailMessage->line3 ?? 'If you did not create an account, no further action is required.');//'心当たりがない場合は、本メールを破棄してください。よろしくお願いいたします。NAGOYAMESHI'
        });
    }
}
