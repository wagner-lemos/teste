<?php
	function slug($text)
	{
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, '-');
		$text = preg_replace('~-+~', '-', $text);
		$text = strtolower($text);

		if (empty($text)) {
			return '';
		}

		return $text;
	}

	function incluirData($data){
		return	substr ($data, 6, 4).'/'.
				substr ($data, 3, 2).'/'.
				substr ($data, 0, 2);
	}
	
	function status($id, $status, $rota)
	{
		if($status == "on"){
			$css = "on";
			$ico = "fas fa-check";
		}else{
			$css = "off";
			$ico = "fas fa-ban";
		}

		return "<span id='modStatus_hide_".$id."'><a href='#' onclick=\"return OnOff('".site_url($rota."/".$id."/".$status)."', 'modStatus_hide_".$id."', '');\" class='check ".$css."'><i class='".$ico."'></i></a></span>";
	}

	function selectOption($array, $id = null)
	{
		if($id != null)
		{
			foreach($array as $key => $value)
			{
				$k = array_keys($value);

				if($id == $value[$k[0]]){
					$lista = '<option value="'.$value[$k[0]].'">'.$value[$k[1]].'</option>';
					unset($array[$key]);
					break;
				}
			}
		}else{
			$lista = '<option value="">Selecione uma opção</option>';
		}

		foreach($array as $key => $value)
		{
			$k = array_keys($value);

			$lista .= '<option value="'.$value[$k[0]].'">'.$value[$k[1]].'</option>';
		}

		return $lista;
	}
?>