<?php

include_once "mode.php";

$messages = [
	"Kana" => 	[
		GOODMORNING => [
			//"greeting" => [
			//	"おはよー！"
			//],
			"pattern1" =>		[
				"text_segment1" => [
					"今日も"
				],
				"text_segment2" => [
					"生きてて", "起きられて"
				],
				"text_segment3" => [
					"えらいえらい！", "えらいね！", "立派だね！"
				],
			],
			"pattern2" =>		[
				"text_segment1" => [
					"生きてる", "起きてる"
				],
				"text_segment2" => [
					"ってだけで"
				],
				"text_segment3" => [
					"立派だよ！", "すごいことなんだよ！", "えらいんだよ！"
				],
			],
			"pattern3" => 	[
				"text_segment1" => [
					"あいさつ"
				],
				"text_segment2" => [
					"できるなんて、", "できてるね。"
				],
				"text_segment3" => [
					"えらい！", "すごいすごい！", "立派立派！"
				],
			],
			"pattern4" => 	[
				"text_segment1" => [
					"大丈夫、きっといい一日になるよ！",
					"今日も元気出して行こー！ おー！",
					"あ、起きた？ じゃあ、ご褒美に頭なでてあげる！",
					"えい、ぎゅー！ え、これ？ 生きててくれてありがとうのハグ！",
					"よく眠れた？ 眠るのって気持ちいいよね！",
					"ごはん食べる？ 食事は元気の源だよ！"
				],
				"text_segment2" => [
					""
				],
				"text_segment3" => [
					""
				],
			],
		],
		OUTGOING => [
			"pattern1" =>	[
				"text_segment1" => [
					"行ってらっしゃい！ 帰り、待ってるからね！"
				],
				"text_segment2" => [
					""
				],
				"text_segment3" => [
					""
				],
			],
		],
		COMEHOME => [
			"pattern1" =>	[
				"text_segment1" => [
					"おかえり！ 今日もお疲れさま！"
				],
				"text_segment2" => [
					""
				],
				"text_segment3" => [
					""
				],
			],
		],
		GOODNIGHT => [
			"pattern1" =>	[
				"text_segment1" => [
					"おやすみ！ いい夢見られるといいね！"
				],
				"text_segment2" => [
					""
				],
				"text_segment3" => [
					""
				],
			],
		],
	],
	//"Noa" => 	[
	//],
];


?>
