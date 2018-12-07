<?php

require_once File::build_path(array("config","Conf.php"));

class Model {

    public static $pdo;

    public static function Init() {

        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue au niveau de la connexion de la base de données !  <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }

    }

   
    
    public static function selectAll() {
        $table_name = static::$object;
        $class_name = 'Model'.$table_name;
            
                $rep = Model::$pdo->query("SELECT * FROM ".$table_name.";");
                $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
                $tab = $rep->fetchAll();
                return $tab; 
        }
        

    public static function select($primary_value) {

        $table_name = static::$object;
        $class_name = "Model".$table_name;
        $primary_key = static::$primary;

        try {
            $sql = "SELECT * from ".$table_name." WHERE ".$primary_key."=:primary_key";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "primary_key" => $primary_value
            );
            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab= $req_prep->fetchAll();

            if (empty($tab)){
                return false;
            }
            return $tab[0];

        } catch (PDOException $e) {
            if (Conf::isDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
    
    public static function recherche($name) {

        $table_name = static::$object;
        $class_name = "Model".$table_name;
        $name_element = static::$name;

        try {
            $sql = "SELECT * from ".$table_name." WHERE ".$name_element." LIKE :name_element";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "name_element" => '%'.$name.'%'
            );
            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab= $req_prep->fetchAll();

            if (empty($tab)){
              return 1;
            }
            return $tab;

        } catch (PDOException $e) {
            if (Conf::isDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function delete($primary) {

        $table_name = static::$object;
        $primary_key = static::$primary;

        try {
            $sql = "DELETE FROM $table_name WHERE $primary_key=:primary_key";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "primary_key" => $primary
            );
            $req_prep->execute($values);

        } catch (PDOException $e) {
            if (Conf::isDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public function update($data) {

        $table_name = static::$object;
        $primary_key = static::$primary;
        //echo $primary_key;
        //echo $table_name;
        
        $values = array();
        $set="";
        //print_r($data);
        
        foreach ($data as $key=>$value) {
            $set.="$key=:$key, ";
            $values[$key]=$value;
        }
        $set = substr($set, 0, -2);
        
        try {
            $sql = "UPDATE $table_name SET $set WHERE $primary_key=:$primary_key;";
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
        }
        catch (PD0Exception $e) {
            if (Conf::isDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
        return true;
    }

    public function save() {

        $table_name = static::$object;
        

        $columnStr = "";
        $valueStr = "";
        $values = array();

        $reflect = new ReflectionObject($this);
       
        
        foreach ($reflect->getProperties(ReflectionProperty::IS_PRIVATE) as $prop) {
            $col=$prop->getName();   
            $columnStr.="$col, ";
            $valueStr.=":$col, ";
            $get = "get".ucfirst($col);
            $values[$col]=$this->$get();
        }
        

        $columnStr = substr($columnStr, 0, -2);
        $valueStr = substr($valueStr, 0, -2);
        
        try {
            $sql = "INSERT INTO $table_name ($columnStr) VALUES ($valueStr)";
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($values);
        
        } catch (PDOException $e) {
            if($e->getCode()==23000)
                return false;
            if (Conf::isDebug()) {
                echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
        return true;
    }
}

Model::Init();