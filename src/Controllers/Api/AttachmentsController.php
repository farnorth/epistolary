<?php

namespace Pilaster\Newsletters\Controllers\Api;

use Illuminate\Http\Request;
use Pilaster\Newsletters\Controllers\Controller;
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

        if (!$file) {
            return response()->json(['error' => 'no file...'], 400);
        }

        $path = config('newsletters.attachments.path');
        $name_prefix = $request->input('file_name', 'newsletter-attachment');
        $uuid = base64_encode(Uuid::uuid4());
        $name_extension = $file->getClientOriginalExtension();
        $name = sprintf('%s--%s.%s', $name_prefix, $uuid, $name_extension);

        $file = $file->move($path, $name);

        return response()->json($file->getFilename());
    }
}
