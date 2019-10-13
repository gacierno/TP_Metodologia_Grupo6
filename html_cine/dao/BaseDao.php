<?php
namespace dao;

abstract class BaseDao{

    protected $itemList = array();
    protected $itemType;


    function getList(){

    }

    function getById( $id){

    }

    function add( $obj ){

    }

    function update( $id , $obj ){

    }

    function delete( $id ){
        $this->retrieveData();
        foreach ( $this->itemList as $key => $post) {
            if( $post['id'] == $id ){
                unset($this->itemList[$key]);
                $this->SaveAll();
                return true;
            }
        }
        return false;

    }

    protected function retrieveData(){

        $jsonList = ( file_exists( dirname(__DIR__).'/data/'. $this->itemType .'.json' ) ) ? file_get_contents( dirname(__DIR__).'/data/'. $this->itemType .'.json' ) : '[]' ;
        $this->itemList = json_decode($jsonList, TRUE);

	}

    protected function SaveAll(){

        $listToFile = json_encode( $this->itemList, JSON_PRETTY_PRINT );
        file_put_contents( dirname(__DIR__).'/data/'. $this->itemType .'.json', $listToFile );
    
    }

    protected function setItemType( $type ){
        $this->itemType = $type;
    }

}


 ?>
