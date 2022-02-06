<?php

namespace App\HandlerNewNews\HandlerImg;

class ServiceImg
{
    private $image;
    private int $image_type;
    private string $file;
    private string $text;
    private string $fileNameWithoutPermission;
    private string $pathSaveFileWithoutPermission;
    private string $background;

    /**
     * @param string $text
     * @param string|null $file
     */
    public function __construct(string $text, string $file = null)
    {
        $this->background = storage_path('fon.png');
        $this->file = $file ?: $this->background;
        $this->text = $text;
        $this->fileNameWithoutPermission = sha1($text);
        $this->pathSaveFileWithoutPermission = public_path('image') . "/" . $this->fileNameWithoutPermission;
    }

    /**
     * @return void
     */
    public function load(): void
    {
        $image_info = getimagesize($this->file);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($this->file);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($this->file);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($this->file);
        } else {
            $this->image = imagecreatefrompng($this->background);
        }
    }

    /**
     * @return void
     */
    public function save(): void
    {
        if ($this->image_type == IMAGETYPE_JPEG) {
            $fullPathFile = $this->pathSaveFileWithoutPermission . ".jpeg";
            imagejpeg($this->image, $fullPathFile);
            imagedestroy($this->image);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $fullPathFile = $this->pathSaveFileWithoutPermission . ".gif";
            imagegif($this->image, $fullPathFile);
            imagedestroy($this->image);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $fullPathFile = $this->pathSaveFileWithoutPermission . ".png";
            imagepng($this->image, $fullPathFile);
            imagedestroy($this->image);
        } else {
            print_r("\n" . "ERROR SAVE IMJ" . "\n");
        }
    }

    /**
     * @return void
     */
    public function crop(): void
    {
        $width = $this->getWidth();
        $height = $this->getHeight();
        if ($width > ($height * 1.5)) {
            $x1 = ($width - (1.5 * $height)) / 2;
            $x2 = 1.5 * $height;
            $y1 = 0;
            $y2 = $height;

        } else {
            $x1 = 0;
            $x2 = $width;
            $y1 = ($height - ($width / 1.5)) / 2;
            $y2 = $width / 1.5;
        }
        $this->image = imagecrop($this->image, ['x' => $x1, 'y' => $y1, 'width' => $x2, 'height' => $y2]);
    }

    /**
     * @return void
     */
    public function createImg(): void
    {
        $arr = HandleTextForImage::start($this->text,30);
        $fontPath = storage_path('font.ttf');
        $text_color = imagecolorallocate($this->image, 0, 0, 0);


        for ($y = 50, $i = 0; $y < 400 & $i < count($arr) ; $y += 40, $i +=1 ) {
            imagettftext($this->image, 20, 0, 40, $y, $text_color, $fontPath, $arr[$i]);
        }
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return imagesx($this->image);
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return imagesy($this->image);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        if ($this->image_type == IMAGETYPE_JPEG) {
            return "image/" . $this->fileNameWithoutPermission . ".jpeg";
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            return "image/" . $this->fileNameWithoutPermission . ".gif";
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            return "image/" . $this->fileNameWithoutPermission . ".png";
        }  else {
            return "image/" . "ERROR" . ".png";
        }
    }
}
