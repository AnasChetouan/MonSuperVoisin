<?php 
  class Dispatcher {
    
    
    public static function myGet($nomvar){
      
      if(isset($_GET[$nomvar])){
          return $_GET[$nomvar];
      }else if(isset($_POST[$nomvar])){
            return $_POST[$nomvar];
            }else{
              return NULL;
            }
    }
    
  }
  