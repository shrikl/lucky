<?php 
	function transform($sec) { 
  
		$output = ''; 
  
		$hours = floor($sec / 3600); 
		$remainSeconds = $sec % 3600; 
  
		$minutes = floor($remainSeconds / 60); 
		$seconds = $sec - $hours * 3600 - $minutes * 60; 
  
		if($sec >= 3600) { 
			$output .= $hours.' 小时 '; 
			$output .= $minutes.' 分钟 '; 
		} 
  
		if($sec >= 60 && $sec < 3600) { 
			$output .= $minutes.' 分钟 '; 
		} 
  
		return $output;
	}

	function calculateBF($arr, $etime) {
		$stime = $arr['stime'];
		$time = $etime - $stime;
		$hours = floor($time / 3600);
		$remainSeconds = $time % 3600;
		$minutes = floor($remainSeconds / 60);
		$total = 0;
		$v = $arr['vnumber'];
		$hp = $arr['pnumber'] / 2;
		if($time >= 3600) {
			$total += $hours * 150;
			if($minutes >= 15 && $minutes < 30) {
				$total += 37.5;
			}else if($minutes >= 30 && $minutes < 45) {
				$total += 75;
			}else if($minutes >= 45 && $minutes < 60) {
				$total += 112.5;
			}
		}else{
			if($minutes >= 15 && $minutes < 30) {
				$total += 37.5;
			}else if($minutes >= 30 && $minutes < 45) {
				$total += 75;
			}else if($minutes >= 45 && $minutes < 60) {
				$total += 112.5;
			}
		}
		if($v >= $hp) $total = $total * 0.8;
		$total = $total + $arr['y2s'] * 2 + $arr['y4s'] * 4;
		return $total;
	}

	function calculateDT($arr, $etime) {
		// 判断当日or跨日
		$stime = $arr['stime'];
		$ch1   = date('d', $stime);
		$ch2   = date('d', $etime);
		$w     = date('w', $stime); // 判断周中还是周末 -- 0 表示星期日 6 表示 星期六
		if($ch1 == $ch2) {
			// 当日
			$time  = $etime - $stime;
			$hours = floor($time / 3600);
			$remainSeconds = $time % 3600;
			$minutes = floor($remainSeconds / 60);

			$ptotal = 0;
			$vtotal = 0;
			
			$ptotal += $hours * 18; //18/小时
			$vtotal += $hours * 15; //15/小时

			if($minutes >= 15 && $minutes < 30) {
				$ptotal += 4.5;  //15分钟<=4.5元<30分钟
				$vtotal += 3.75; //15分钟<=3.75元<30分钟
			}else if($minutes >= 30 && $minutes < 45) {
				$ptotal += 9;  //30分钟<=9元<45分钟
				$vtotal += 7.5;//30分钟<=7.5元<45分钟
			}else if($minutes >= 45 && $minutes < 60) {
				$ptotal += 13.5; //45分钟<=13.5元<60分钟
				$vtotal += 11.25;//45分钟<=11.25元<60分钟
			}

			if($w == 0 || $w == 6) { //周末
				if($ptotal > 68) $ptotal = 68;
				if($vtotal > 55) $vtotal = 55;
			}else{
				if($ptotal > 58) $ptotal = 58;
				if($vtotal > 45) $vtotal = 45;
			}
			
			$total = $ptotal * ($arr['pnumber'] - $arr['vnumber'])
					 + $vtotal * ($arr['vnumber'] - $arr['vipcard'])
					 + $arr['y2s'] * 2
					 + $arr['y4s'] * 4;
			return $total;
		}else{
			// 跨日
			$mtime1 = strtotime(date('Y-m-d', $arr['stime']) . " 23:59:59");
			$mtime2 = strtotime(date('Y-m-d', $etime) . " 00:00:01");
			$arr1['stime'] = $arr['stime'] - 1;
			$arr1['pnumber'] = $arr['pnumber'];
			$arr1['vnumber'] = $arr['vnumber'];
			$arr1['vipcard'] = $arr['vipcard'];
			$arr1['y2s'] = 0;
			$arr1['y4s'] = 0;	

			$arr2['stime'] = $mtime2;
			$arr2['pnumber'] = $arr['pnumber'];
			$arr2['vnumber'] = $arr['vnumber'];
			$arr2['vipcard'] = $arr['vipcard'];
			$arr2['y2s'] = $arr['y2s'];
			$arr2['y4s'] = $arr['y4s'];	

			return calculateDT($arr1, $mtime1) + calculateDT($arr2, $etime + 1);
		}
	}
?>