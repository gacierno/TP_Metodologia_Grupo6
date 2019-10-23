<?php
namespace dao;

use dao\Connection as Connection;

abstract class BaseDao{

    protected $itemList = array();
    protected $tableName;
    protected $singleType;
    protected $connection;


    public function getList(){

        $output = array();
        $query = "select * from ". $this->tableName;
        try {
            $this->connection = Connection::GetInstance();
            $output = $this->connection->Execute( $query );
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
        return $this->parseToObjects( $output );

    }

    public function getById( $id ){
        $output = false;
        $query = "select * from ". $this->tableName . " where id_". strtolower( $this->singleType ) ." = ". $id.";";
        try {
            $this->connection = Connection::GetInstance();
            $output = $this->connection->Execute( $query );
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        return $this->parseToObjects( $output );
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
        $this->itemList = $this->retrieveData();
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
        $this->itemList = $this->retrieveData();
        foreach ( $this->itemList as $key => $post) {
            if( $post['id'] == $id ){
                unset($this->itemList[$key]);
                $this->SaveAll();
                return true;
            }
        }
        return false;

    }


    public function setTableName( $type ){
        $this->tableName = $type;
    }

    public function setSingleType( $type ){
        $this->singleType = $type;
    }

    public function parseToObjects( $arr ){ }

    public function parseToObject( $hash ){ }

    public function parseToHash( $obj ){ }
}


 ?>
