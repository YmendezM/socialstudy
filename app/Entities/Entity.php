<?php
namespace TeachMe\Entities;
 
use Illuminate\Database\Eloquent\model;

 class Entity extends Model
 {
 	
 	 public static function getClass()
 	 {
 	 	return get_class(new static);


 	 }
 }