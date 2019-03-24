<?php
 
echo "Hello, Heroku!";
/*echo rand() % 1;
$array1 = array("array!");
echo $array1[rand() % 1];
$array_text_segment1 = array("今日も");
$array_text_segment2 = array("生きてて");
$array_text_segment3 = array("えらいえらい！");

$text_segment1 = $array_text_segment1[rand() % 1];
$text_segment2 = $array_text_segment2[rand() % 1];
$text_segment3 = $array_text_segment3[rand() % 1];

$return_message_text = $text_segment1 . $text_segment2 . $text_segment3;
echo $return_message_text;
 */

$accessToken = 'mWbndsAPe5j0UvAvpkll+GfFdluug8RKZiLLta2cd3qNBiK/wF1OgA1ifzxFYZ8QwvaF3wJJCUL2Pvtfwxi3o+P+B7ImZt4dR6XZpY36/7Eai38V0jucNFH4U2Xhd1ZfZBcTfuqKeYmYGxOzFTdT0AdB04t89/1O/w1cDnyilFU=';
//$accessToken =  'y7LKpDt4OxHVS9qafyajq6bWlyc7H/rni0bXY65TIOZ0uJbRlflXub10GneSJebGUgjINXHXUasop6VJORPXtYAI8dsE1lDjlPdGgpNetRriWpB7xWc5Bwysq1ZIJ7i8dXggvFXCHP4WCxtw4TuXpwdB04t89/1O/w1cDnyilFU=';

//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$json_object = json_decode($json_string);
 
//取得データ
$replyToken = $json_object->{"events"}[0]->{"replyToken"};        //返信用トークン
$message_type = $json_object->{"events"}[0]->{"message"}->{"type"};    //メッセージタイプ
$message_text = $json_object->{"events"}[0]->{"message"}->{"text"};    //メッセージ内容
 
//メッセージタイプが「text」以外のときは何も返さず終了
if($message_type != "text") exit;
 
//返信メッセージ
if($message_text != "おはよう！") 
	exit;

$array_text_segment1 = array("今日も");
$array_text_segment2 = array("生きてて");
$array_text_segment3 = array("えらいえらい！!");

$text_segment1 = $array_text_segment1[rand() % 1];
$text_segment2 = $array_text_segment2[rand() % 1];
$text_segment3 = $array_text_segment3[rand() % 1];

$return_message_text1 = $text_segment1 . $text_segment2 . $text_segment3;
$return_message_text2 = "今日も生きててえらいえらい！";

// insert usleep() to make bots looks real
$random = rand(100, 300); 
$sleeptime = $random / 100.0 * 1000000;
usleep($sleeptime);
 
//返信実行
sending_messages($accessToken, $replyToken, $message_type, $return_message_text1);
sending_messages($accessToken, $replyToken, $message_type, $return_message_text2);
?>
<?php
//メッセージの送信
function sending_messages($accessToken, $replyToken, $message_type, $return_message_text){
    //レスポンスフォーマット
    $response_format_text = [
        "type" => $message_type,
        "text" => $return_message_text
    ];
 
    //ポストデータ
    $post_data = [
        "replyToken" => $replyToken,
        "messages" => [$response_format_text]
    ];
 
    //curl実行
    $ch = curl_init("https://api.line.me/v2/bot/message/reply");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charser=UTF-8',
        'Authorization: Bearer ' . $accessToken
    ));
    $result = curl_exec($ch);
    curl_close($ch);
}
?>
