<?php 
$testtw = array();
$res=array();
$main = array();
$wh=array();
$i=0;
$j=0;
$keys = $_POST['key'];

include "twitteroauth/twitteroauth.php";

$consumer_key = "";
$consumer_secret = "";
$access_token = "";
$access_token_secret = "";


$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);
$tweets = $twitter->get("https://api.twitter.com/1.1/search/tweets.json?q=%23whirldata&result_type=recent&count=20&include_rts=1");
$tweets1 = $twitter->get("https://api.twitter.com/1.1/search/tweets.json?q=%23whirldata&result_type=recent&count=1000&include_entities=false");
//print_r(json_encode($tweets));

foreach ($tweets1->statuses as $key => $tweet) { 


$res[$i]=$tweet->user->screen_name;

$i++;
}

$vals = array_count_values($res);
arsort($vals);


$main[0] = $vals;

$i=0;
$testtw->twittercnt = $vals;


foreach ($tweets->statuses as $key => $tweet) { 

$testtw[$i]->src = $tweet->user->profile_image_url;
$testtw[$i]->text = $tweet->text;
$testtw[$i]->timeline = $tweet->user->screen_name;
$testtw[$i]->img = $tweet->entities->media[0]->media_url;
$t=$tweet->created_at;
$testtw[$i]->time= tweetTime($t);



$i++;
}
$main[1] = $testtw;
print_r(json_encode($main));
//print_r($main);


	function tweetTime( $t ) {
	/**** Begin Time Loop ****/
	// Set time zone
	date_default_timezone_set('America/New_York');
	// Get Current Server Time
	$server_time = $_SERVER['REQUEST_TIME'];
	// Convert Twitter Time to UNIX
	$new_tweet_time = strtotime($t);
	// Set Up Output for the Timestamp if over 24 hours
	$this_tweet_day =  date('D. M j, Y', strtotime($t));
	// Subtract Twitter time from current server time
	$time = $server_time - $new_tweet_time;			
	// less than an hour, output 'minutes' messaging
	if( $time < 3599) {
		$time = round($time / 60) . ' minutes ago';
			}
	// less than a day but over an hour, output 'hours' messaging 
	else if ($time >= 3600 && $time <= 86400) {
		$time = round($time / 3600) . ' hours ago';
		}
	// over a day, output the $tweet_day formatting
	else if ( $time > 86400)  {
		$time = $this_tweet_day;
		}
	// return final time from tweetTime()
	return $time;
	/**** End Time Loop ****/
	}

  








?>
