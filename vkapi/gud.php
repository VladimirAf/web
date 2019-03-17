<?php


class apiVK {
 private $key;
 private $comnumber;
 private $chooseDate;
 private $mode;
 private $mean=0;
 private $list15=array();

 function __construct($key,$comnumber,$chooseDate){
    $this->key = $key;
    $this->comnumber = $comnumber;
    $this->chooseDate = $chooseDate;
 }

 public function getStatistic() {
 	$this->calcResponseMode();
 	return array($this->mode,$this->mean,$this->list15);
 }
  
 private function calcResponseMode(){
 	$data = $this->getDialogTimeArray();
 	rsort($data);
 	$current=0;
 	$h=1000;
 	$mode = array();
 	$mode[] = array('many'=>1,'time'=>0);
 	$mode_i = 0;
 	$this->mean=$data[0];
 	for ($i=1; $i < count($data); $i++){ 
 	    $this->mean+=$data[$i];	
 	 	if($data[$current]-$data[$i]<=$h){
 	 		$mode[count($mode)-1]['many']+=1;
 	 		$mode[count($mode)-1]['time']+=$data[$current]+$data[$i];
 	 	}
 	 	else {
 	 		$mode_i++;
 	 		$mode[]=array('many'=>1,'time'=>0);
 	 		$current=$i;
 	 		}
 	 }
   	 arsort($mode);
   	 $mode = array_shift($mode);
   	 $this->mean=round($this->mean/(count($data)*60));
 	 $this->mode=round($mode['time']/($mode['many']*60)); 			
 }

 private function getDialogTimeArray(){
 	$query = sprintf("https://api.vk.com/method/messages.getDialogs?v=5.41&access_token=%s&count=20&offset=0",$this->key);
 	$result = json_decode(file_get_contents($query));
 	$data = array();
	foreach ($result->{'response'}->{'items'} as $key => $value) {
		// printf(($value->message->date)."\n");
		if((floor($value->message->date / 86400)) === (floor($this->chooseDate / 86400)))
			$data = array_merge($this->getHistoryDialogTimeArray($value->message->user_id),$data);
	}
	return $data;

 }

 private function getHistoryDialogTimeArray($user_id){
 	$query = sprintf("https://api.vk.com/method/messages.getHistory?v=5.92&access_token=%s&count=20&offset=0&user_id=%s&rev=1",$this->key,$user_id);
 	$result = json_decode(file_get_contents($query));
 	$data =array();
 	$next = 0;
	foreach ($result->{'response'}->{'items'} as $key => $value) {
		if(preg_match(sprintf('/%s/',$this->comnumber), $value->{'from_id'})){
		   $response_time = $value->date;
		   $i=$key-1;
		   while ( $result->{'response'}->items[$i]->from_id !== $user_id){
		   	 if(preg_match(sprintf('/%s/',$this->comnumber), $result->{'response'}->items[$i]->from_id)) {
		   	 	break;
		   	 	$i=-1;
		   	   }
		   	 $i--;
		   } 
		   if($i<0) continue;	 
		   $message_time = $result->{'response'}->items[$i]->date;
		   $data[] = $response_time-$message_time;
		   if((($response_time-$message_time) / 60) > 15){
		   	$this->list15[] = $result->{'response'}->items[$i]->text;
		   	$this->list15[] = $value->text;
		   }
		   	
		 }
		 $next++;
		}
	return $data;	
 }


}


?>