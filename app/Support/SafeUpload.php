<?php

namespace App\Support;

use App\Ajuste;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SafeUpload
{
    public static function storeDocument(UploadedFile $file, string $directory): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $mime = (string) $file->getMimeType();
        $allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'odt', 'ods', 'jpg', 'jpeg', 'png', 'zip'];
        $blockedExtensions = ['php', 'phtml', 'php3', 'php4', 'php5', 'phar', 'exe', 'js', 'html', 'htm', 'svg', 'sh', 'bat', 'cmd', 'com', 'msi'];
        $blockedMimes = [
            'text/html',
            'application/x-httpd-php',
            'application/x-php',
            'text/x-php',
            'image/svg+xml',
            'application/javascript',
            'text/javascript',
        ];

        if (in_array($extension, $blockedExtensions, true) || in_array($mime, $blockedMimes, true) || ! in_array($extension, $allowed, true)) {
            throw ValidationException::withMessages([
                'archivo' => 'Tipo de archivo no permitido. Use PDF, Office o una imagen.',
            ]);
        }

        self::assertSize($file);

        return $file->store($directory);
    }

    public static function delete($path): void
    {
        if (! is_string($path) || $path === '') {
            return;
        }

        Storage::delete($path);
    }

    public static function storeImage(UploadedFile $file, string $directory): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $mime = (string) $file->getMimeType();
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'ico'];
        $imageMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $iconMimes = ['image/x-icon', 'image/vnd.microsoft.icon', 'image/ico', 'application/octet-stream'];

        $mimeOk = in_array($mime, $imageMimes, true) || ($extension === 'ico' && in_array($mime, $iconMimes, true));

        if (! in_array($extension, $allowed, true) || ! $mimeOk) {
            throw ValidationException::withMessages([
                'archivo' => 'La imagen debe ser jpg, png, gif, webp o ico.',
            ]);
        }

        self::assertSize($file);

        return $file->store($directory);
    }

    public static function pdfError(UploadedFile $file): ?string
    {
        if (strtolower($file->getClientOriginalExtension()) !== 'pdf' || $file->getMimeType() !== 'application/pdf') {
            return 'El archivo debe ser un PDF válido.';
        }

        if ($file->getSize() > self::maxBytes()) {
            return 'El archivo supera el tamaño máximo permitido.';
        }

        return null;
    }

    private static function assertSize(UploadedFile $file): void
    {
        if ($file->getSize() > self::maxBytes()) {
            throw ValidationException::withMessages([
                'archivo' => 'El archivo supera el tamaño máximo permitido.',
            ]);
        }
    }

    private static function maxBytes(): int
    {
        try {
            $bytes = (int) Ajuste::where('nombre', 'Peso archivo (B)')->value('valor');
        } catch (\Throwable $e) {
            $bytes = 0;
        }

        return $bytes > 0 ? $bytes : 10485760;
    }
}
