<?php

use Carbon\Carbon;
use \DetectLanguage\DetectLanguage;
DetectLanguage::setApiKey(Config::get('var.detect_key'));
class Helpers {

	public static function dateEmpty( $date ){

		if(!is_object($date)){

			$date = Helpers::createCarbonDate($date)->toDateString();
		}

		if($date == '-0001-11-30'){

			return true;
		}

		return false;
	}
	public static function title( $str ){

		return substr($str, 0, 44);
	}

	public static function description( $str ){

		return substr($str, 0, 165);
	}

	public static function footer(){

		return Post::wherePostTypeId(2)->with('translation')->get();
	}
	public static function imgDir( $path, array $params){

		foreach($params as $key => $value){

			$path = str_replace(':'.$key, $value ,$path );

		}

		return $path;


	}

	public static function attr( $validator ){

		return $validator->setAttributeNames(trans('validation.attributes'));

	}

	public static function transDecode($str) {
		return preg_replace_callback("/\\\u([0-9a-f]{4})/i",
			create_function('$matches',
				'return html_entity_decode(\'&#x\'.$matches[1].\';\', ENT_QUOTES, \'UTF-8\');'
				), $str);
	}

	public static function addBeforeExtension( $stringWithExt, $string ){

		$stringEx = explode( '.', $stringWithExt );

		return  $stringEx[0].'-'.$string.'.'.$stringEx[1] ;

	}


	public static function retinaFilename( $stringWithExt, $string ){

		$stringEx = explode( '.', $stringWithExt );

		return  $stringEx[0].$string.'.'.$stringEx[1] ;

	}

	public static function replaceExtension( $string, $extension ){

		$stringEx = explode( '.', $string );

		return $stringEx[0].'.'.$extension;
	}

	public static function translate($text, $from=null, $to){

		$text = urlencode($text);

		if(Helpers::isNotOk($from)){

			$from = DetectLanguage::detect($text)[0]->language;
		}

		$ch = curl_init('https://api.datamarket.azure.com/Bing/MicrosoftTranslator/v1/Translate?Text=%27'.$text.'%27&From=%27'.$from.'%27&To=%27'.$to.'%27');
		curl_setopt($ch, CURLOPT_USERPWD, Config::get('var.bing_key').':'.Config::get('var.bing_key'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		$result = explode('<d:Text m:type="Edm.String">', $result);

		$result = explode('</d:Text>', $result[1]);
		$result = $result[0];
		return $result;

		/*return Helpers::transDecode($translation[1]);*/
	}
	public static function removeBOM($str = "") {
		if (substr($str, 0, 3) == pack("CCC",0xef,0xbb,0xbf)) {
			$str=substr($str, 3);
		}
		return $str;
	}
	public static function curl($url,$params = array(),$is_coockie_set = false)
	{

		if(!$is_coockie_set){
			/* STEP 1. let’s create a cookie file */
			$ckfile = tempnam ("/tmp", "CURLCOOKIE");

			/* STEP 2. visit the homepage to set the cookie properly */
			$ch = curl_init ($url);
			curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec ($ch);
		}

		$str = ''; $str_arr= array();
		foreach($params as $key => $value)
		{
			$str_arr[] = urlencode($key)."=".urlencode($value);
		}
		if(!empty($str_arr))
			$str = '?'.implode('&',$str_arr);

		/* STEP 3. visit cookiepage.php */

		$Url = $url.$str;

		$ch = curl_init ($Url);
		curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

		$output = curl_exec ($ch);
		return $output;
	}

	/**
	*
	* Add timestamp to img name
	*
	**/

	public static function addTimestamp( $image , $type = null , $ext = null, $timestamp = null ){

		if(Helpers::isOk( $image )  &&  explode( '.', $image )){

			$imageEx = explode( '.', $image );

			if( Helpers::isNotOk( $timestamp )){

				$name = $imageEx[0].date('dmYhis'); 
			}
			else{
				
				$name = $imageEx[0].$timestamp; 
			}

			if( Helpers::isOk( $ext )){

				$extension = $ext;
			}
			else
			{
				$extension = $imageEx[1]; 

			}
			if( Helpers::isOk( $type )){

				return sha1($name).$type. '.' .$extension;
			}
			else
			{
				return sha1($name). '.' .$extension;	
			}
			
		}
		else
		{

			return false;

		}
	}

	

	public static function createEmailKey( $email ){

		return sha1(mt_rand(10000,99999).date('dmyhms').$email);

	}
	public static function isCurrentLanguage( $shortLanguage ){

		if(App::getlocale() == $shortLanguage){

			echo 'active';
		}
	}

	public static function getQuery(){

		return dd(DB::getQueryLog());
	}

	public static function displayHumanDate( $date , $format = '$d $nd $M $y $hh$m' , $year=null){

		if(Carbon::now()->year == $date->year && Helpers::isNotOk($year)){

			$year = "";

		}else{

			$year = $date->year;

		}

		$result = array(
			'y' => $year,
			'M' => trans('general.month')[$date->month],
			'nd' => $date->day === 1 ? $date->day.'<sup>'.trans('general.first_day').'</sup>' : $date->day,
			'd' => trans('general.days')[$date->dayOfWeek],
			'h' => $date->hour,
			'm' => $date->minute < 10 ? '0'.$date->minute :$date->minute,
			's' => $date->second < 10 ? '0'.$date->second : $date->second,
			);

		$date = str_replace('$d', $result['d'], $format);

		$date = str_replace('$nd', $result['nd'], $date);

		$date = str_replace('$M', $result['M'], $date);

		$date = str_replace('$y', $result['y'], $date);

		$date = str_replace('$h', $result['h'], $date);

		$date = str_replace('$m', $result['m'], $date);

		$date = str_replace('$s', $result['s'], $date);

		return $date;

	}
	public static function beTime( $timestamp ,  $format = '$d $nd $M $y $hh$m', $year=null){
		if(is_object($timestamp)){
			return Helpers::displayHumanDate($timestamp->setTimezone('Europe/Brussels'), $format , $year);
		}
		return '';
	}
	public static function cacheEager( $key){

		return function($query) use($key){

			$query->remember(Config::get('var.remember'), $key);
		};
	}
	public static function cache( $query, $name, $time = 1440 ){

		if (!Cache::has($name)) {

			$cache = Cache::remember($name, $time , function() use($query)
			{
				return $query;
			});

			return $cache;

		} else {

			return Cache::get($name);

		}

	}
	public static function wellDisplayPhone( $string ){

		if( strlen( $string ) === 9){

			$prefix = str_split($string, 3)[0];
			$num = str_split(str_split($string, 3)[1].str_split($string, 3)[2], 2);

			return $prefix.' '.$num[0].' '.$num[1].' '.$num[1];

		}else if(strlen( $string ) === 10){

			$prefix = str_split($string, 4)[0];
			$num = str_split(str_split($string, 4)[1].str_split($string, 4)[2], 2);

			return $prefix.' '.$num[0].' '.$num[1].' '.$num[1];

		}else{

			$strings =  str_split( $string , 2);
			$stringToReturn = '';

			foreach ( $strings as $string ){

				$stringToReturn = $stringToReturn.$string.' ';

			}

			return $stringToReturn;
		}

	}
	public static function toHumanDiff( $timestamp ){

		return $timestamp->diffForHumans(Carbon::now());
	}
	public static function toHumanTimestamp( $timestamp ){

		setlocale(LC_TIME, App::getLocale());  

		return $timestamp->formatLocalized('%e %B %Y %k:%M:%S');
	}
	public static function createCarbonTimestamp( $timestamp, $type='us',  $separator = '-' ){

		Helpers::toHumanTimestamp($timestamp);

	}
	public static function getDateBetween( $start, $end ){
		$dateBetween  = array();
		$start = Helpers::createCarbonDate( $start);
		$end = Helpers::createCarbonDate( $end);
		if(Helpers::isOk($start) && Helpers::isOk($end)){
			$diff = $start->diffInDays($end);

			for($a=0;$a <= $diff; $a++){

				array_push($dateBetween , $start->toDateString());

				$start->addDay();
			}
		}
		return $dateBetween;
	}
	public static function isLast( $current, $total ){

		if($current >= $total){
			return true;
		}
		else{
			
			return false;
		}
	}	
	public static function isNotLast( $current, $total ){

		if($current >= $total){
			
			return false;

		}
		else{

			return true;

		}
	}
	public static function isActive( $currentRoute, $route=null ){

		if(Helpers::isOk($route)){


			if( $route === $currentRoute){

				echo 'class="active"';

			}

		}else{

			if( Route::current()->getName() === $currentRoute){

				echo 'class="active"';

			}
		}
	}
	public static function getFilterBy( $string ){

		if(Helpers::isOk( $string )){

			return explode( ':', $string )[0];
		}

	}
	public static function getFilterWay( $string ){

		if(Helpers::isOk( $string )){

			return explode( ':', $string )[1];
		}

	}
	public static function getLangId( $langId )
	{
		if(Helpers::isOk( $langId , 'int'))
		{

			return $langId;

		}else{

			return (int)Language::whereShort(Config::get('app.locale'))->first(['id'])->id;
		}
	}
	public static function cleanString( $string ){

		$cleanString = str_replace( ' ', '', $string );
		$cleanString = preg_replace('/[^A-Za-z0-9\-]/', '', $cleanString);
		$cleanString = strtolower( $cleanString );

		return $cleanString;

	}
	
	/**
	*
	* Convertis une string vers une string sluge (informations très personnelles => informations-tres-personnelles)
	*
	**/
	public static function toSlug( $string, $charset = 'utf-8' ){
		

		$string = htmlentities($string, ENT_NOQUOTES, $charset);
		$string = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $string);
		$string = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $string); 
		$string = preg_replace('#&[^;]+;#', '', $string); 
		$string = strtolower( $string );

		return str_replace(' ' , '-' , $string );

	}
	
	public static function isStar( $number , $star ){ 
		//order 3 on 3.5 star

		if($number > $star){

			if($star - $number < 0 && $star - $number > -1 && !is_int($star)){

				return 'icon-mini9';

			}

			return 'icon-star51';

		}else{

			if($star - $number < 0 && $star - $number > -1  && !is_int($star)){

				return 'icon-mini9';
			}

			return 'icon-bookmark';
		}

	}
	public static function getRating ( $rating ){

		return round( $rating * 10 ) / 10;

	}
	public static function extractLatLng( $latlng , $type ){

		if(Helpers::isOk( $latlng )){

			$explode = explode(',' , $latlng);

			if(
				$type === 'lat'
				|| $type === 'Lat'
				||$type == '0'
				){

				return  (int)$explode[0];
		}
		elseif(
			$type === 'lng' 
			|| $type === 'Lng' 
			|| $type == '0'
			){

			return (int)$explode[1];
	}
}else{

	return false;
}



}

public static function isOk ( $data , $type = ""){

	if(isset( $data )){

		if(!empty( $type )){

			if( isset($data->errors) ){

				return false;
			}
			else{

				if(
					isset($data)
					&& $data !== "undefined"
					&& $data!== null
					&& count($data) > 0
					&& $data === $type	
					&& !empty( $data )
					){

					return true;

			}else{

				return false;

			}
		}
	}else{

		if( isset($data->errors) ){
			return false;
		}else{

			if(
				isset($data)
				&& $data !== "undefined"
				&& $data!== null
				&& count($data) > 0
				&& !empty( $data )
				){

				return true;

		}else{

			return false;

		}
	}
}
}
else
{
	return false;
}
}
public static function isNotOk ( $data , $type = ""){

	if(!empty( $type )){

		if( isset($data->errors) ){
			
			return true;
		}else{

			if(
				!isset($data)
				|| empty( $data )
				|| $data === null
				|| count($data) <= 0
				|| $data !== $type	
				){

				return true;

		}else{

			return false;

		}
	}

}else{

	if( isset($data->errors) ){

		return true;

	}else{

		if(
			!isset($data)
			|| $data === null
			|| empty( $data )
			|| count($data) <= 0
			){

			return true;

	}else{

		return false;

	}
}

}

}
public static function sGetLatLng( $sLatlng , $type ){
	if(isset($type) && $type === "lat"){

		$explode = explode(',',$sLatlng);
		return $explode['0'];

	}elseif(isset($type) && $type === "lng"){

		$explode = explode(',',$sLatlng);
		return $explode['1'];
	}		

}
public static function dateEu( $date ){

	$dateExplode = explode('-',$date);

	return $dateExplode[2].'/'. $dateExplode[1].'/'.$dateExplode[0];
}
public static function toPhpdate( $date ){

	$dateExplode = explode('/',$date);

	return $dateExplode[2].'-'. $dateExplode[1].'-'.$dateExplode[0];
}
public static function toPercent( $value , $on, $diff=null )
{
	if($on != 0){

		if(Helpers::isOk($diff)){

			return round(100 - (($value / $on ) * 100) );

		}else{

			return round(($value / $on ) * 100 );

		}
	}
	else{

		return NULL;
	}

}
public static function dateNaForm( $date ){

	$dateExplode = explode('-',$date);

	if(isset($dateExplode[2])){

		return $dateExplode[2].'-'. $dateExplode[1].'-'.$dateExplode[0];
	}
	else{

		return null;
	}
}
public static function createCarbonDate( $date ){

	$dateExplode = explode('-',$date);
	if(isset($dateExplode[0]) && isset($dateExplode[1]) && isset($dateExplode[2]) ){
		return Carbon::createFromDate($dateExplode[0], $dateExplode[1], $dateExplode[2]);
	}
	return '';

}
public static function humanDay( $date ){

	switch ($date) {
		case 0:
		return "Dimanche";
		break;
		case 1:
		return "Lundi";
		break;
		case 2:
		return "Mardi";
		break;
		case 3:
		return "Mercredi";
		break;
		case 4:
		return "Jeudi";
		break;
		case 5:
		return "Vendredi";
		break;
		case 6:
		return "Samedi";
		break;

	}
}
public static function build_calendar($month,$year,$dateArray) {
	$user = unserialize(Session::get('user'));
	$sceances = Prof::getSceanceAndCours($user->id);
	$today_date = date("d");
	$today_date = ltrim($today_date, '0');
     // Create array containing abbreviations of days of week.

	$daysOfWeek = array('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');

     // What is the first day of the month in question?
	$firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // How many days does this month contain?
	$numberDays = date('t',$firstDayOfMonth);

     // Retrieve some information about the first day of the
     // month in question.
	$dateComponents = getdate($firstDayOfMonth);

     // What is the name of the month in question?
	$monthName = $dateComponents['month'];
	switch ($monthName) {
		case "January":
		$monthName =  "Janvier";
		break;
		case "February":
		$monthName =  "Février";
		break;
		case "March":
		$monthName =  "Mars";
		break;
		case "April":
		$monthName =  "Avril";
		break;
		case "May":
		$monthName =  "Mai";
		break;
		case "June":
		$monthName =  "Juin";
		break;
		case "July":
		$monthName =  "Juillet";
		break;
		case "August":
		$monthName =  "Août";
		break;
		case "September":
		$monthName =  "Septembre";
		break;
		case "October":
		$monthName =  "Octobre";
		break;
		case "November":
		$monthName =  "Novembre";
		break;
		case "December":
		$monthName =  "Décembre";
		break;
	}
     // What is the index value (0-6) of the first day of the
     // month in question.
	$dayOfWeek = $dateComponents['wday']-1;
	if ($dayOfWeek < 0) {
		$dayOfWeek = 6;
	}
     // Create the table tag opener and day headers

	$calendar = "<table class='calendar'>";
	$calendar .= "<caption>$monthName $year</caption>";
	$calendar .= "<tr>";

     // Create the calendar headers

	foreach($daysOfWeek as $day) {

		$calendar .= "<th class='header'><span class='jour'>$day</span></th>";
	} 

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

	$currentDay = 1;

	$calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

	if ($dayOfWeek > 0) {
		for($i = 0;$i<$dayOfWeek;$i++){ 
			$calendar .= "<td class='day old' colspan='$dayOfWeek'>&nbsp;</td>"; 
		}
	}

	$month = str_pad($month, 2, "0", STR_PAD_LEFT);

	while ($currentDay <= $numberDays) {

          // Seventh column (Saturday) reached. Start a new row.

		if ($dayOfWeek == 7) {

			$dayOfWeek = 0;
			$calendar .= "</tr><tr>";

		}

		$currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);

		$date = "$year-$month-$currentDayRel";





		if($currentDayRel == $today_date ){  
			$calendar .= "<td class='day today' ><a data-date='$date' data-day='$day' href=''><span class='number'>$currentDay</span>";
		} 

		else { 
			$calendar .="<td class='day' ><a data-date='$date' data-day='$day' href=''><span class='number'>$currentDay</span>"; 
		}

		if(isset($dateArray[mktime(0, 0, 0, $month, $currentDay, $year)])){
			$calendar.=$dateArray[mktime(0, 0, 0, $month, $currentDay, $year)];
		}
		foreach($sceances as $sceance){

			if($sceance->date === $date){
				$duree = "h-".substr($sceance->duree, 0, 1);

				$calendar .='<ol class="sceances">';

				$calendar .="<li class='$duree oneSceance' data-cours='$sceance->coursSlug' data-sceance='$sceance->sceancesId'>";
				$calendar .="<span>$sceance->coursNom</span>";

				$calendar .='</li>';

				$calendar .='</ol>';


			}

		}
		$calendar.="</a></td>";
          // Increment counters

		$currentDay++;
		$dayOfWeek++;

	}



     // Complete the row of the last week in month, if necessary

	if ($dayOfWeek != 7) { 

		$remainingDays = 7 - $dayOfWeek;
		$calendar .= "<td colspan='$remainingDays'>&nbsp;</td>"; 

	}

	$calendar .= "</tr>";

	$calendar .= "</table>";

	return $calendar;

}

}