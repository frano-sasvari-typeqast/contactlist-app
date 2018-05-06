<?php

namespace App\Http\Uploads;

use Uploadify\UploadifyManager;
use Intervention\Image\ImageManager;
use Illuminate\Contracts\Filesystem\Factory as Storage;

abstract class Upload
{
    /**
     * The uploadify manager instance
     *
     * @var \Uploadify\UploadifyManager
     */
    protected $uploadifyManager;

    /**
     * The internvetion image manager
     *
     * @var \Intervention\Image\ImageManager
     */
    protected $imageManager;

    /**
     * The filesystem factory (storage) instance
     *
     * @var \Illuminate\Contracts\Filesystem\Factory
     */
    protected $storage;

    /**
     * Create new upload instance
     *
     * @param  \Uploadify\UploadifyManager  $uploadifyManager
     * @param  \Intervention\Image\ImageManager  $imageManager
     * @param  \Illuminate\Contracts\Filesystem\Factory  $storage
     * @return void
     */
    public function __construct(UploadifyManager $uploadifyManager, ImageManager $imageManager, Storage $storage)
    {
        $this->uploadifyManager = $uploadifyManager;
        $this->imageManager = $imageManager;
        $this->storage = $storage;
    }

    /**
     * Create intervention image class
     *
     * @param  mixed  $file
     * @param  int  $width
     * @param  int  $height
     * @return string
     */
    protected function createInternvetionImage($file, $width, $height)
    {
        return $this->imageManager
            ->make($file)
            ->orientate()
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
    }
}
