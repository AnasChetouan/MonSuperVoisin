<?php 
  class Dispatcher {
    
    
    public function myGet($nomvar){
      
      if(isset($_GET[$nomvar])){
          return $_GET[$nomvar];
      }else if(isset($_POST[$nomvar])){
            return $_POST[$nomvar];
            }else{
              return NULL;
            }
    }
    
  }
  
// On ne ferme pas la balise php car la classe est completée et fermée plus tard dans le routeur