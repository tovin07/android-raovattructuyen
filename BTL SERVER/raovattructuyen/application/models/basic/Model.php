<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author misugi_jun91
 */
class Model {
   public function __get($name){
       $getter='get'.$name;
       if(method_exists($this, $getter)){
           return $this->$getter();
       }
   }
   
   public function __set($name,$value){
       $setter='set'.$name;
       if(method_exists($this, $setter)){
           return $this->$setter($value);
       }
       
   }
}
?>
