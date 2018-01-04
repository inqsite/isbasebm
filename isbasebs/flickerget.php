<?php
/*
Template Name: flicker
*/
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	

<?php

	//ライブラリを読み込む
	require_once 'inc/phpFlickr.php' ;

	// Consumer Key
	$app_key = '3637eb3a8c88af3edbc40ca9130465fc' ;

	// Consumer Secret
	$app_secret = 'debd164bf1055786' ;

	// インスタンスを作成する
	$flickr = new phpFlickr( $app_key , $app_secret ) ;

	//オプションの設定
	$option = array(
		'sort' => 'interestingness-desc',
		'text' => '三保の松原' ,		// 検索ワードの指定
		'per_page' => 10 ,			// 取得件数
		'extras' => 'url_q,url_c,owner_name' , 		// 画像サイズ
		'safe_search' => 1 ,		// セーフサーチ
		'license' => 1,2,3,4,5,6,7,8 ,

	) ;

	// GETメソッドで指定がある場合
	foreach( array( 'text' , 'per_page' , 'woe_id' , 'license' , 'sort' , 'bbox' , 'license' , 'sort' ) as $val )
	{
		if( isset( $_GET[ $val ] ) && $_GET[ $val ] != '' )
		{
			$option[ $val ] = $_GET[ $val ] ;
		}
	}

	// 検索を実行し、取得したデータを[$result]に代入する
	$result = $flickr->photos_search( $option ) ;


	// [$result]をJSONに変換する
	$json = json_encode( $result );

	// JSONをオブジェクト型に変換する
	$obj = json_decode( $json ) ;
	
		// リスト形式で表示する
	$html .= '<ul style="margin:2em 0 0; padding:0; overflow:hidden; list-style-type:none; text-align:center;">' ;
	echo '<ul style="margin:2em 0 0; padding:0; overflow:hidden; list-style-type:none; text-align:center;">' ;
	// ループ処理
	foreach( $obj->photo as $photo )
	{
		// データが揃っていない場合はスキップ
		if( !isset($photo->url_q) || !isset($photo->width_q) || !isset($photo->height_q) )
		{
			continue ;
		}
		// データの整理
		$t_src = $photo->url_q ;		// サムネイルの画像ファイルのURL
		$t_width = $photo->width_q ;	// サムネイルの横幅
		$t_height = $photo->height_q ;	// サムネイルの縦幅
		$o_src = ( isset($photo->url_c) ) ? $photo->url_c : $photo->url_q ;		// 画像ファイルのURL

		// 出力する
		echo '<li style="float:left; margin:1px; padding:0; ">' ;
		echo 	'<a href="' . $o_src . '" target="_blank">' ;
		echo 		'<img src="' . $t_src . '" width="' . $t_width . '" height="' . $t_height . '" style="max-width:100%; height:auto">' ;
		echo 	'</a><br>' ;
		echo 'by <a href="https://www.flickr.com/photos/'.$photo->owner.'/'.$photo->id.'/">'.$photo->ownername.'</a>' ;
		echo '</li>' ;






		// データの整理
		$t_src = $photo->url_q ;		// サムネイルの画像ファイルのURL
		$t_width = $photo->width_q ;	// サムネイルの横幅
		$t_height = $photo->height_q ;	// サムネイルの縦幅
		$o_src = ( isset($photo->url_c) ) ? $photo->url_c : $photo->url_q ;		// 画像ファイルのURL

		// 出力する
		$html .= '<li style="float:left; margin:1px; padding:0; overflow:hidden; height:112.5px">' ;
		$html .= 	'<a href="' . $o_src . '" target="_blank">' ;
		$html .= 		'<img src="' . $t_src . '" width="' . $t_width . '" height="' . $t_height . '" style="max-width:100%; height:auto">' ;
		$html .= 	'</a>' ;
		$html .= '</li>' ;
	}
echo '</ul>' ;
	$html .= '</ul>' ;
	
	echo $html;
	
	echo '<pre>';
	print_r($result);
	echo '</pre>';
	?>
	</body>
</html>