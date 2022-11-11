<?php

namespace App\Traits\Media;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait MediaHelpers
{
    public static function make($directory, User $user = null, $tag = null): static
    {
        $media = new static;
        $media->id = $media->max('id') + 1;
        $media->user_id = $user ? $user->id : auth()->id();
        $media->directory = $directory;
        $media->tag = $tag;

        return $media;
    }

    public function tag($tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function model(Model $model): static
    {
        $this->mediable_id = $model->id;
        $this->mediable_type = get_class($model);

        return $this;
    }

    public function upload(UploadedFile $file): static
    {
        $path = $file->store($this->directory);

        try {
            $this->name = $file->getClientOriginalName();
            $this->extension = $file->getClientOriginalExtension();
            $this->mime_type = $file->getMimeType();
            $this->size = kbFromBytes($file->getSize());
            $this->path = $path;

            $this->save();
        } catch (Exception $exception) {
            Storage::delete($path);

            throw $exception;
        }

        return $this;
    }

    public function delete(): ?bool
    {
        $this->unlink();

        return parent::delete();
    }

    public function unlink(): void
    {
        Storage::delete($this->path);
    }
}
