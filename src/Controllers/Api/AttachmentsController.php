<?php

namespace Pilaster\Epistolary\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Pilaster\Epistolary\Controllers\Controller;
use Ramsey\Uuid\Uuid;

class AttachmentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $name_prefix = $request->input('file_name', 'newsletter-attachment');
        $name_suffix_type = $request->input('file_suffix_type', 'date');
        $path = config('epistolary.attachments.storage');

        if (!$file) {
            return response()->json(['error' => 'no file...'], 400);
        }

        $name = $this->get_unique_name($file, $path, $name_prefix, $name_suffix_type);
        $file = $file->move($path, $name);

        return response()->json($file->getFilename());
    }

    /**
     * Get a unique file name.
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $prefix
     * @param string $suffix_type
     * @return string
     */
    private function get_unique_name($file, $path, $prefix, $suffix_type = 'date')
    {
        $name_extension = $file->getClientOriginalExtension();
        $suffix = $this->get_suffix($suffix_type);
        $name = sprintf('%s--%s.%s', $prefix, $suffix, $name_extension);

        $good = false;
        $count = 1;
        while (!$good) {
            if (file_exists(sprintf('%s/%s', $path, $name))) {
                $count++;
                $name = sprintf('%s--%s--%s.%s', $prefix, $suffix, $count, $name_extension);
            } else {
                $good = true;
            }
        }

        return $name;
    }

    /**
     * Get a string of the specified type.
     *
     * @param string $suffix_type
     * @return mixed
     */
    private function get_suffix($suffix_type)
    {
        switch ($suffix_type) {
            case 'date':
                return date("Y-m-d");
            case 'datetime':
                return date("Y-m-d H:i:s");
            case 'timestamp':
                return time();
            case 'hash':
                return base64_encode(Uuid::uuid4());
            default:
                return time();
        }
    }
}
