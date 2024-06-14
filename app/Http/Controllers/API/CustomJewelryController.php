<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomJewelryMail;
use Illuminate\Support\Facades\Log;

class CustomJewelryController extends Controller
{
    public function sendEmail(Request $request)
    {
        try {
            Log::info('Received request for sending email', $request->all());

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'type' => 'required|string|max:255',
                'message' => 'required|string',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Store uploaded images temporarily
            $uploadedImages = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('public/images');
                    $uploadedImages[] = storage_path('app/' . $path);
                }
            }

            $data = $request->all();
            $data['images'] = $uploadedImages;

            Log::info('Sending email with data', $data);

            Mail::to('iliya32005@yandex.ru')->send(new CustomJewelryMail($data));

            Log::info('Email sent successfully');

            return response()->json(['message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['message' => 'Error sending email'], 500);
        }
    }
}
