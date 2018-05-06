<?php

namespace App\Http\Uploads;

use App\Http\Uploads\Upload as BaseUpload;
use App\Model\Contact;

class ContactUploadAvatar extends BaseUpload
{
    /**
     * Database field used for upload logic
     *
     * @var string
     */
    protected $field = 'upload_avatar';

    /**
     * Create new contact avatar upload
     *
     * @param  mixed  $file
     * @return string
     */
    public function upload($file)
    {
        $contact = new Contact();

        $uploadify = $this->uploadifyManager->create($file, $contact, $this->field);

        $image = $this->createInternvetionImage($file, 600, 600);

        $uploadify->process($image);
        $uploadify->upload();

        return $uploadify->getName();
    }
}
