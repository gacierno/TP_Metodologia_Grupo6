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
        $result = array();
        $query = "select * from ". $this->tableName . " where ". strtolower( $this->singleType ) ."_id = ". $id.";";
        try {
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute( $query );
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
        if( sizeof($result) > 0 ){
            $output = $this->parseToObject( $result[0] );
        }else{
            $output = false;
        }
        return $output;
    }


    public function add( $obj ){
        if( is_null( $obj->getId() ) || !$this->getById( $obj->getId() ) ){ 

            $options = $this->getFields( $obj );

            $query = "insert into " .$this->tableName. $options;

            $params = $this->parseToHash($obj);

            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery( $query, $params );
            } catch (PDOException $e) {
                throw $e;
                return false;
            } catch (Exception $e) {
                throw $e;
                return false;
            }

            return true;
        }
        return false;
    }




    public function update( $id , $obj ){

        // update autos   -- TABLENAME
        // set kilomentros = 0  -- FIELDS
        // where kilometros > 20000;  -- CONDICION

        $hash = $this->parseToHash($obj);

        foreach ( $hash as $key => $value ) {

            $query = "update ". $this->tableName ." set ".$key." = ".$value." where ".$this->singleType."_id like %".$id."%;";

            try {
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery( $query );
            } catch (PDOException $e) {
                throw $e;
            } catch (Exception $e) {
                throw $e;
            }
        
        }
        
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


    /*
     * getTableFields
     */
    public function getFields( $obj ){

        $output = array(
            'keys'      => array(),
            'values'    => array()

        );

        $hash = $this->parseToHash($obj);

        foreach ($hash as $key => $value ) {
            array_push( $output['keys'], $key );
            array_push( $output['values'], ":".$key );
        }

        return 
            " (".
            preg_replace( "/[ \[ \] \" ]/", "", json_encode( $output['keys'] ) )
            .") values (".
            preg_replace( "/[ \[ \] \" ]/", "", json_encode( $output['values'] ) )
            .");";
    }


    /**
     * parseToObjects
     * @param Array()
     * @return Array(Cunema)
     */

    public function parseToObjects( $arr ){

        $output = array();
        foreach ( $arr as $value ) {
            array_push( $output, $this->parseToObject( $value ) );
        }
        return $output;
    }

    public function parseToObject( $hash ){ }

    public function parseToHash( $obj ){ }





}



 ?>
