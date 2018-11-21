<?php

class ControllerCommandes{
  protected static $object = 'commandes';

  public static function read(){
    $id = $_GET("primary_value");
    if(ModelCommandes::select($id) != false){
      require File::build_path(array("view", "commandes", "details.php"));
    }else{
      require File::build_path(array("view", "commandes", "error.php"));
    }
  }

  public static function readAll(){
    $id = $_GET("primary_value");
    $commandes_tab = ModelCommandes::selectAll();
  }

  public static function create(){
    require File::build_path(array("view", "commandes", "create.php"));
  }

  public static function created(){
    $commande = new ModelCommandes($_POST['idCommande'], $_POST['idUtilisateur'], $_POST['dateCommande'], $_POST['idStatut'], $_POST['montantCommande'], $_POST['idAdresseLivraison'], $_POST['bloqué'], $_POST['idRole'])
    $commande->save();
    ControllerCommandes::readAll();
  }
}

?>