<?php

namespace App\Notifications\System;

use App\Base\SlackNotification;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Throwable;

class ErrorNotification extends SlackNotification
{
    /** @var Request */
    public Request $request;

    /** @var User|null */
    public Authenticatable|null|User $user;

    protected string $content = 'Whoops! Something went wrong.';

    protected string $level = 'error';

    /** @var Throwable */
    private Throwable $exception;

    /**
     * @param  Throwable  $exception
     * @param  Request  $request
     * @param  Authenticatable  $user
     */
    public function __construct(Throwable $exception, Request $request, Authenticatable $user = null)
    {
        $this->exception = $exception;
        $this->request = $request;
        $this->user = $user;
    }

    protected function channel(): string
    {
        return config('services.slack.log-channel');
    }

    protected function fields(): array
    {
        $e = $this->exception;

        $fields = collect([
            'Request URL' => $this->request->fullUrl(),
            'Request Type' => $this->request->getMethod(),
            'Code' => $e->getCode(),
            'Message' => $e->getMessage(),
            'File' => $e->getFile(),
            'Line' => $e->getLine(),
        ]);

        if ($this->user) {
            $fields->put('User ID', $this->user->id);
            $fields->put('User Name', $this->user->name);
        }

        return $fields->toArray();
    }
}
