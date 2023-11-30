<?php 

namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    private $uploadsDirectory;

    public function __construct(string $UploadsDirectory)
    {
        $this->uploadsDirectory = $UploadsDirectory;
    }

    public function upload(UploadedFile $file): string
    {
        try {
            $imageName = uniqid() . '.' . $file->guessExtension();
            $file->move($this->uploadsDirectory, $imageName);

            return $imageName;
        } catch (\Exception $e) {
            // Gérez l'erreur (par exemple, journalisation)
            throw new \Exception('Erreur lors du téléchargement de l\'image.');
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