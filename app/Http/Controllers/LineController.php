<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class LineController extends Controller
{
    public function index(Request $request){
        error_log(json_encode($request->all()['events'][0]['message']['text']));
        error_log(json_encode('1'));
        $replyToken = $request['events'][0]['replyToken'];
        $text = $request->all()['events'][0]['message']['text'] ?? '';

        switch ($text) {
            case '早安':
                $messages =[
                    [
                        'type'=>'text',
                        'text'=>'安'
                    ]
                ];
                $this->replyToLine($replyToken,$messages);
                break;
            case '午安':
                $messages =[
                    [
                        'type'=>'text',
                        'text'=>'安'
                    ],[
                        "type"=> "image",
                        "originalContentUrl"=> "https://example.com/original.jpg",
                        "previewImageUrl"=> "https://example.com/preview.jpg"
                    ]
                ];
                $this->replyToLine($replyToken,$messages);
                break;
            default:
                # code...
                break;
        }
        return response('ok','200');
    }
    public function replyToLine($replyToken,$messages)
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.env('LINE_CHANNEL_ACCESS_TOKEN')
        ])->post('https://api.line.me/v2/bot/message/reply',[
            'replyToken'=>$replyToken,
            'messages'=>$messages
        ]);
    }

}
