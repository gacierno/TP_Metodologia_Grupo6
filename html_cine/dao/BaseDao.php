<?php
namespace dao;

abstract class BaseDao{

  function update( $id , $obj ){

  }

  function delete( $id , $obj ){

    foreach ( $this->retrieveData() as $key=>$post) {
      if($post->getID() == $id){
        unset($this->postsList[$key]);
        $this->SaveAll();
        return true;
      }
    }
    return false;

  }

  private function retrieveData(){

	}

}


 ?>
