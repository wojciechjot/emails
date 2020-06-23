<?php

namespace App\Http\Controllers;

use App\Mail\TestowyMail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function emails(Request $request)
    {
        $email = $request->input('email');

        try {
            Mail::to($email)->send(new TestowyMail());
        } catch (\Swift_TransportException $exception) {
            dd($exception);
        }

        return response()->json(
            ['message' => 'Email has been sent.'],
            Response::HTTP_CREATED
        );
    }
}
