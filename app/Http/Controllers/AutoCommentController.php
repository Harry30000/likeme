<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AutoCommentRequest;
use App\User;

class AutoCommentController extends Controller
{
    public function curl_post($url, $postfields)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    public function Index()
    {
        return view('layouts.auto-comment');
    }

    public function AutoComment(AutoCommentRequest $request)
    {
        $id = $request->fbid;
        $limit = $request['limit'];
        $message = $request['message'];

        foreach(explode("\n", $request['message']) as $message)
        {
            $arr[] = $message;
        }

        // Lấy random $limit access_token trong bảng user với vip = 0
        $results = User::where('vip', 0)->select('id','name','access_token')->inRandomOrder()->take($limit)->get();

        foreach ($results as $result)
        {
            $access_token = $result['access_token'];
            $rank_key = array_rand($arr, 1);
            $postFields = array('message' => $arr[$rank_key], 'access_token' => $access_token);
            $postresult = $this->curl_post('https://graph.facebook.com/'.$id.'/comments', $postFields);

            print_r($postresult).'<br>';
        }
    }
}
