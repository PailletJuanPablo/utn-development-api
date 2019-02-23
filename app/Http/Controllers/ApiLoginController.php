<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function __construct()
    {
        $this->client = new Client();
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        $fileUrl = null;
        $password = $request->password;
        if ($request->token) {
            $facebookBaseApi = "https://graph.facebook.com/me?fields=id,email,name,picture.type(large)&access_token=" . $request->token;
            $response = $this->client->get($facebookBaseApi, ['verify' => false, 'exceptions' => false]);
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody()->getContents(), true);
    
            if ($statusCode != 200) {
                return response()->json(["error" => 'Missing or invalid Token'], 400);
            };

            if ($content['picture']['data']['url']) {
                $image = file_get_contents($content['picture']['data']['url']);
                $fileToSave = $image->store('users');
                $fileUrl = Storage::url($fileToSave);
              //  \File::put(storage_path() . '/users/' . $user->id . '.png', $image);
            }
            if($content['email']){
                $email = $content['email'];
            }

            if($content['name']){
                $name = $content['name'];
            }
        }  

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $request->passwod,
                'image' => $fileUrl
            ]);
        }

        $dataToEncode = array(
            "id" => $user->id,
        );
        
        $fcmEncoderKey = env('JWT_SECRET_KEY', 'secret');
        $accessToken = JWT::encode($dataToEncode, $fcmEncoderKey);
        $user->save();

        return response()->json(
            [
                "accessToken" => $accessToken,
            ]
        );
    }
}
