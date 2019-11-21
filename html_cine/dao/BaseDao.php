<?php
namespace dao;

use dao\Connection as Connection;
use dao\ICrud as ICrud;

abstract class BaseDao implements ICrud{

    protected $itemList = array();
    protected $tableName;
    protected $singleType;
    protected $connection;

    public $resultado_query;


    public function getList( $criteria = array() , $conector = 'AND', $logical = '=' ){

        $output = array();
        $query = "select * from ".$this->tableName;

        if( sizeof( $criteria ) != 0 ){

            $query .= " where ";

            $i = 0;
            foreach ( $criteria as $key => $value) {
                $query .= $key." ".$logical." '".$value."'";
                $i++;
                if( $i < sizeof($criteria) ){
                    $query .= " ".$conector." ";
                }
            }
            $query .= ";";
        }

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

    public function getListWhere( $criteria = array() ){

        $output = array();
        $query = "select * from ".$this->tableName;

        if( sizeof( $criteria ) != 0 ){

            $query .= " where 1 ";

            foreach($criteria as $line){
              $query .= " " . $line['condition'] . " " . $line['column'] . " " . $line['operator'] . " '" . $line['value'] . "'";
            }

            $query .= ";";


        }

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

    public function readAll(){

        $output = array();
        $query = "select * from ".$this->tableName. ";";

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
        $created = false;
        if( is_null( $obj->getId() ) || !$this->getById( $obj->getId() ) ){

            $options = $this->getFields( $obj );

            $query = "insert into " .$this->tableName. $options;

            $params = $this->parseToHash($obj);

            try {
                $this->connection = Connection::GetInstance();
                $created = $this->connection->ExecuteNonQuery( $query, $params );
            } catch (PDOException $e) {
                throw $e;
            } catch (Exception $e) {
                throw $e;
            }

        }
        return $created;

    }


    public function update( $obj ){
        $updated = false;
        $id   = $obj->getId();
        $hash = $this->parseToHash($obj);

        $query = "update ". $this->tableName ." set ";

        $i = 0;
        foreach ( $hash as $key => $value ) {
            $query .= $key." = '".$value."'";
            $i++;
            $query .= ( $i < sizeof($hash) )? ", " : " ";
        }


        $query.= "where ".$this->singleType."_id = ".$id.";";


        try {
            $this->connection = Connection::GetInstance();
            $updated = $this->connection->ExecuteNonQuery( $query );
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

        return $updated;

    }



    public function delete( $id ){
        $query = "update ". $this->tableName ." set ".$this->singleType."_available = 0 where ".$this->singleType."_id = ".$id.";";

        try {
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery( $query );
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }

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
