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
            'keyFilePath' => base_path(''),
            'projectId' => ''
        ]);
        $language = $cloud->language();
        $annotation = $language->analyzeSentiment($text);
        $sentiment = $annotation->sentiment();
$score=$sentiment['score'];
$magnitude=$sentiment['magnitude'];
$class="";

if ($score>0)
    $class="positive";
elseif ($score<0)
    $class="negative";
elseif ($score==0)
    $class="neutral";

        return(compact('score','magnitude','class'));
    }
    public function get_post_sentiment($id)
    {
        $senti=DB::select("SELECT Sentiment_class FROM comments where post_id='$id'");
        return response()->json($senti);
    }
}
