<?php

namespace App\Http\Controllers\Quote\Sign;

use Illuminate\Support\Facades\Storage;

class UploadSignature
{
    private $path;
    private $exists;

    public function __construct($data)
    {
        $this->path = $this->_path($data);
        $this->exists = $this->_exists($data);
    }

    public function path()
    {
        return $this->path;
    }

    public function exists()
    {
        return $this->exists;
    }

    public function storage($data_image)
    {
        $image = file_get_contents($data_image);

        Storage::disk('s3')->put($this->path, $image);
    }

    private function _path($data)
    {
        $client = $data['client'];

        if ($data['proposal_id']) {
            $subfolder = 'proposal';
            $type_id = $data['proposal_id'];
        } else {
            $subfolder = 'confirmation';
            $type_id = $data['confirmation_id'];
        }

        return "signed-contracts/$client/$subfolder/$type_id/signature.png";
    }

    private function _exists()
    {
        return Storage::disk('s3')->exists($this->path);
    }
}
