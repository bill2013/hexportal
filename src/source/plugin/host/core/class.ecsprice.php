<?php

Class ecsPrice{
	var $cpu=null,$ram=null,$storage=null,$bandwidth=null,$os=null;
	function __construct($cpu=null, $ram=null, $storage=null, $bandwidth=null, $os=null ){
		if($cpu!==null)$this->cpu=$cpu;//else return false;
		if($ram!==null)$this->ram=$ram;//else return false;
		if($storage!==null)$this->storage=$storage;//else return false;
		if($bandwidth!==null)$this->bandwidth=$bandwidth;//else return false;
		if($os!==null)$this->os=$os;
	}

	function getprice(){
		$a=array('{',
			'"commodityCode": "vm",',
			'"childs": {',
				'"vm_cpu": "'.$this->cpu.'",',
				'"vm_ram": "'.$this->ram.'",',
				'"vm_storage": "'.$this->storage.'",',
				'"vm_bandwidth": "'.$this->bandwidth.'",',
				'"vm_os": "'.$this->os.'"',
			'}',
		'}');

		$b=base64_encode(join('',$a));
		//echo $b;
		$x=file_get_contents('http://buy.aliyun.com/api/get_price?data='.$b);
		preg_match_all("([\d]{1,10})",$x,$y);
		//echo $b;
		$a=array();
		$a['month']=$y[0][1];
		$a['year']=$y[0][2];
		return json_encode($a);
	}
}


?>