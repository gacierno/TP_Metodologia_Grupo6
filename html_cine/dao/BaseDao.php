<?php
namespace dao;

abstract class BaseDao{

    protected $itemList = array();
    protected $itemType;


    public function getList(){

        $output = array();
        $this->retrieveData();
        return $this->parseToObjects( $this->itemList );

    }

    public function getById( $id ){
        $output = false;
        // THIS SENTENCE VOIDS DATA DELETIONS WHILE UPDATING LIST
        if( sizeof($this->itemList) == 0 ) $this->retrieveData();

        foreach ($this->itemList as $value){
            if( $value['id'] == $id ) {
                $output = $this->parseToObject($value);
            };
        }
        return $output;
    }


    public function add( $obj ){
        if( !$this->getById( $obj->getId() ) ){ //getById executes retrieve data

            if( is_null($obj->getId()) ){
                $obj->setId( time() );  // SETTING A TIMESTAMP AS CINEMA ID
            }
            $hash = $this->parseToHash( $obj );
            array_push( $this->itemList , $hash );
            $this->SaveAll();
            return true;
        }
        return false;
    }




    public function update( $id , $obj ){
        $this->retrieveData();
        foreach ( $this->itemList as $key=>$post) {
            if($post['id'] == $id){
                $hash = $this->parseToHash( $obj );
                $this->itemList[$key] = $hash;
                $this->SaveAll();
                return true;
            }
        }
        return false;
    }



    public function delete( $id ){
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

    public function retrieveData(){

        $jsonList = ( file_exists( dirname(__DIR__).'/data/'. $this->itemType .'.json' ) ) ? file_get_contents( dirname(__DIR__).'/data/'. $this->itemType .'.json' ) : '[]' ;
        $this->itemList = json_decode($jsonList, TRUE);

	}

    public function SaveAll(){

        $listToFile = json_encode( $this->itemList, JSON_PRETTY_PRINT );
        file_put_contents( dirname(__DIR__).'/data/'. $this->itemType .'.json', $listToFile );
    
    }

    public function setItemType( $type ){
        $this->itemType = $type;
    }

    public function parseToObjects( $arr ){ }

    public function parseToObject( $hash ){ }

    public function parseToHash( $obj ){ }
}


 ?>
