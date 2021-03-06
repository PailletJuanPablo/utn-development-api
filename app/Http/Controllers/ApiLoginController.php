<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;

class ApiLoginController extends Controller
{
    public function __construct()
    {
        $this->client = new Client();
    }

    public function login(Request $request)
    {
        $fileUrl = null;
        $facebookBaseApi = "https://graph.facebook.com/me?fields=id,email,name,picture.type(large)&access_token=" . $request->token;
        $response = $this->client->get($facebookBaseApi, ['verify' => false, 'exceptions' => false]);
        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody()->getContents(), true);

        if ($statusCode != 200) {
            return response()->json(["error" => 'Missing or invalid Token'], 400);
        };

        if ($content['picture']['data']['url']) {
            $image = $content['picture']['data']['url'];
        }
        if ($content['email']) {
            $email = $content['email'];
        }

        if ($content['name']) {
            $name = $content['name'];
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('secret'),
                'image' => $image,
            ]);
        }

        $user->image = $image;
        $user->save();

        $dataToEncode = array(
            "id" => $user->id,
        );

        $fcmEncoderKey = env('JWT_SECRET_KEY', 'secret');
        $accessToken = JWT::encode($dataToEncode, $fcmEncoderKey);

        return response()->json(
            [
                "user" => $user,
                "school" => $user->school
            ]
        );
    }
}
