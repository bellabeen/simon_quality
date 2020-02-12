<?php
class DataFormat{
	function asTable($data){
		$html = "<table>";
		// $html .= "<table border='1'>";
		foreach($data as $k=>$v){
			if ($k==0){
				$html .="<tr>";
				foreach($v as $key=>$value){
					$html .= "<th>".$key."</th>";
				}
				$html .="</tr>";
			}
			$html .= "<tr>";
			if (is_array($v)) {
				foreach($v as $key=>$value){
					$html .= "<td>".$value."</td>";
			}
		} else {
			$html .='<td>'.$v.'<td/>';
		}
		$html .= "</tr>";
	}
        $html .= "<table>";
        return $html;
	}

	function asJSON($data){
		return json_encode($data);
	}

}
