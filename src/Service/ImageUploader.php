<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ImageUploader
{
    private $uploadsDirectory;

    public function __construct(string $uploadsDirectory = 'assets/image')
    {
        $this->uploadsDirectory = $uploadsDirectory;
    }

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $imageName = $originalFilename . '-' . uniqid() . '.' . $file->guessExtension();

        try {
            $file->move($this->uploadsDirectory, $imageName);
            return $imageName;
        } catch (FileException $e) {
            error_log('Exception during file upload: ' . $e->getMessage());
            throw new \Exception('Erreur lors du téléchargement de l\'image. Veuillez consulter les journaux pour plus d\'informations.');
        }
    }

    public function remove(string $imageName): void
    {
        try {
            $filePath = $this->uploadsDirectory . '/' . $imageName;

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        } catch (\Exception $e) {
            // Gérez l'erreur (par exemple, journalisation)
            throw new \Exception('Erreur lors de la suppression de l\'image.');
        }
    }
}
