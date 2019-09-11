<?php

function img($img){
	if($img == ""){
		return asset('avatar.png');
	}else if (strpos($img, 'http') !== false) {
        return $img;
    }else{
		return asset('storage/'.$img);
	}
}
