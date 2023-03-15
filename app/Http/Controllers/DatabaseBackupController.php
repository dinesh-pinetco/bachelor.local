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

    protected string $disk;

    public function __construct()
    {
        $this->linkExpiry = now()->addMinutes(5);
        $this->path = Str::slug(config('app.name'));
        $this->disk = config('backup.backup.destination.disks');
    }

    public function index()
    {
        $returningFiles = collect();

        $files = Storage::disk($this->disk)->allFiles($this->path);

        foreach ($files as $file) {
            [$path, $filename] = explode('/', $file);

            $returningFiles->push([
                'name' => $filename,
                'size' => round(Storage::disk($this->disk)->size($file) / 1024000, 2),
                'url' => route('preview.backup', [$path, $filename]),
                'lastModified' => Carbon::createFromTimestamp(Storage::disk($this->disk)->lastModified($file)),
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

    public function preview($path, $filename)
    {
        return Storage::disk($this->disk)->download("$path/$filename");
    }
}
