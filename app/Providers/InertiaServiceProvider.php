<?php

namespace App\Providers;

use App\Enums\NotificationType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        RedirectResponse::macro(
            'flash',
            function (NotificationType $type, string $body) {
                session()->flash('notification', [
                    'type' => $type,
                    'body' => $body,
                ]);

                /** @var RedirectResponse $this */
                return $this;
            }
        );

        RedirectResponse::macro(
            'success',
            function (string $body) {
                return $this->flash(NotificationType::SUCCESS, $body);
            }
        );

        RedirectResponse::macro(
            'info',
            function (string $body) {
                return $this->flash(NotificationType::INFO, $body);
            }
        );

        RedirectResponse::macro(
            'warning',
            function (string $body) {
                return $this->flash(NotificationType::WARNING, $body);
            }
        );

        RedirectResponse::macro(
            'error',
            function (string $body) {
                return $this->flash(NotificationType::ERROR, $body);
            }
        );
    }
}
