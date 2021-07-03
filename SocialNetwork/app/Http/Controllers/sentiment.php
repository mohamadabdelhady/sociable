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
//        $text = 'I love this product, and i am going to recommend it to all my friends';

// Detect the sentiment of the text
        $annotation = $language->analyzeSentiment($text);
        $sentiment = $annotation->sentiment();
$score=$sentiment['score'];
$magnitude=$sentiment['magnitude'];
$class="";
if ($score==0||$score<=0.3)
    $class="neutral";
elseif ($score>0)
    $class="positive";
elseif ($score<0)
    $class="negative";
//        echo 'Sentiment Score: ' . $sentiment['score'] . ', Magnitude: ' . $sentiment['magnitude'];
        return(compact('score','magnitude','class'));
    }
    public function all_sentiment()
    {
$senti=DB::select('SELECT Sentiment_class FROM comments');


        return response()->json($senti);
    }
    public function post_search_sentiment()
    {
        $q="bla";
        $senti=DB::select("select Sentiment_class FROM comments where post_id IN (select id from posts where post_content like '%$q%')");
        return response()->json($senti);
    }
    public function comment_search_sentiment()
    {
//        $q=$request->q;
        $q="bla";
        $senti=DB::select("select Sentiment_class FROM comments where comment_content='$q'");
        return response()->json($senti);
    }
    public function get_post_sentiment($id)
    {

        $senti=DB::select("SELECT Sentiment_class FROM comments where post_id='$id'");
        return response()->json($senti);
    }
}
