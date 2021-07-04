<?php

namespace App\Http\Controllers;

use Google\Cloud\Core\ServiceBuilder;
use Illuminate\Http\Request;
use DB;

class sentiment extends Controller
{
    public function sentiment($text)
    {
        $cloud = new ServiceBuilder([
            'keyFilePath' => base_path('hangout-318220-29212a1d7657.json'),
            'projectId' => 'hangout-318220'
        ]);
        $language = $cloud->language();
        $annotation = $language->analyzeSentiment($text);
        $sentiment = $annotation->sentiment();
$score=$sentiment['score'];
$magnitude=$sentiment['magnitude'];
$class="";

if ($score>0.3)
    $class="positive";
elseif ($score<0)
    $class="negative";
elseif ($score==0||$score<=0.1)
    $class="neutral";

        return(compact('score','magnitude','class'));
    }
    public function get_post_sentiment($id)
    {
        $senti=DB::select("SELECT Sentiment_class FROM comments where post_id='$id'");
        return response()->json($senti);
    }
}
