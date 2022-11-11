<?php

namespace App\Traits\Livewire;

trait HasModal
{
    public bool $show = false;

    public function hydrateHasModal(): void
    {
        $className = class_basename(static::class);

        $this->listeners = array_merge($this->listeners, [
            "$className.modal.toggle" => 'toggle',
        ]);
    }

    public function toggle(): void
    {
        $this->show = ! $this->show;
    }

    public function open(): void
    {
        $this->show = true;
    }

    public function close(): void
    {
        $this->show = false;
    }
}
