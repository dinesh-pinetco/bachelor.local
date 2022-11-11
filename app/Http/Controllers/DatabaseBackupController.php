<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseBackupController extends Controller
{
    protected \Illuminate\Support\Carbon $linkExpiry;

    protected string $path;

    public function __construct()
    {
        $this->linkExpiry = now()->addMinutes(5);
        $this->path = Str::slug(config('app.name'));
    }

    public function index()
    {
        $returningFiles = collect();

        $files = [];

        if (app()->environment(['staging', 'local'])) {
            $files = Storage::disk(config('filesystems.default'))->allFiles($this->path);
        } elseif (app()->environment('production')) {
            $files = Storage::disk(config('filesystems.default'))->allFiles($this->path);
        }

        foreach ($files as $file) {
            $filename = last(explode('/', $file));

            $returningFiles->push([
                'name' => $filename,
                'size' => round(Storage::size($file) / 1024000, 2),
                'url' => route('preview.backup', $filename),
                'lastModified' => Carbon::createFromTimestamp(Storage::lastModified($file)),
            ]);
        }

        $returningFiles = $returningFiles->sortByDesc('lastModified');

        return view('backups.index')->with('files', $returningFiles);
    }

    public function create()
    {
        Artisan::call('backup:run', ['--only-db' => true]);

        return back()->with('success', 'Backup created successfully!');
    }

    public function preview($file)
    {
        $this->linkExpiry = now()->addMinutes(5);

        return redirect($this->getTemporaryUrl($this->path.'/'.$file));
    }

    protected function getTemporaryUrl($path): string
    {
        if (config('filesystems.default') === 's3') {
            return Storage::temporaryUrl($path, $this->linkExpiry);
        }

        return Storage::url($path);
    }
}
