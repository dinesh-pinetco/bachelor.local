<?php

namespace App\Base;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

abstract class SlackNotification extends Notification
{
    use Queueable;

    protected string $level = 'info';

    /** @var string */
    protected string $content;

    public static function make(...$arguments): static
    {
        return new static(...$arguments);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage())
            ->to($this->getChannel())
            ->{$this->level}()
            ->content($this->content)
            ->attachment(function ($attachment) {
                $attachment->title($this->title(), $this->url())
                    ->fields($this->fields());
            });
    }

    private function getChannel()
    {
        if (app()->environment('local')) {
            return config('services.slack.test-channel');
        }

        return $this->channel();
    }

    protected function channel(): string
    {
        return config('services.slack.notification-channel');
    }

    protected function fields(): array
    {
        return [];
    }

    protected function title(): string
    {
        return '';
    }

    protected function url(): string
    {
        return '';
    }

    public function send()
    {
        \Notification::route('slack', config('services.slack.webhook'))->notify($this);
    }
}
