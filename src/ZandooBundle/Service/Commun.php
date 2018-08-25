<?php
 namespace ZandooBundle\Service;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 class Commun
 {
    public function typeMonnaie($type = true){ return ($type == true) ? "Fc" : "$"; }
    public function dateConvertText($datetime, $full = false)
	{ 
		$now = new \DateTime;
		$ago = $datetime;
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'an',
			'm' => 'mois',
			'w' => 'semaine',
			'd' => 'jour',
			'h' => 'heure',
			'i' => 'minute',
			's' => 'seconde',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? 'Il y à '.implode(', ', $string).'' : 'maintenant';
	}
        
	function testExistanceImg($img){
		return !$img->isEmpty();
	}
	
	function titreFormatAnnonce($_text){ return ucfirst($_text); }
}

