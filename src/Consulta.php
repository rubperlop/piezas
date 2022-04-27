<?php

namespace FormacionAPP;

use PDO;
use PDOStatement;

class Consulta extends BaseQuery {
    public $columnName;

    public $tableName;

    public $value;

    /**
     * @param $columnName
     * @param $tableName
     * @param $value
     */
    public function __construct( $columnName = "", $tableName = "", $value = "" ) {
        parent::__construct();
        $this->columnName = $columnName;
        $this->tableName  = $tableName;
        $this->value      = $value;
    }

    /**
     * Consult data
     *
     * @return false|PDOStatement|void
     */
    public function consult( $columnName, $tableName, $value ) {
        $rows = $this->conn->query( "select * from $tableName where $columnName = '$value'" );

        return $rows->fetchAll( PDO::FETCH_ASSOC );
    }

    /**
     * Insert an unique value to an unique column
     *
     * @return void
     */
    public function insert( $table_name, $column_names, $column_values ) {
        $columns = implode( ',', $column_names );
        $values  = implode( "','", $column_values );

        $insert = $this->conn->prepare( "INSERT INTO $table_name ($columns) VALUES ('$values')" );
        $insert->execute( [
            "$this->value" => $this->columnName,
        ] );
    }

    /**
     * To update data
     *
     * @param string $table_name
     * @param array  $columns_values
     * @param array  $where_values
     *
     * @return void
     */
    public function update( string $table_name, array $columns_values, array $where_values ) {
        $set_placeholders = [];
        foreach ( $columns_values as $key => $value ) {
            $set_placeholders[] = "$key=:$key";
        }
        $set_placeholders = implode( ',', $set_placeholders );

        $where_placeholders = [];
        foreach ( $where_values as $key => $value ) {
            $where_placeholders[] = "$key=:$key";
        }
        $where_placeholders = implode( ' AND ', $where_placeholders );

        $update = $this->conn->prepare( "UPDATE $table_name SET $set_placeholders WHERE $where_placeholders" );
        $update->execute( $columns_values + $where_values );
    }

    /**
     * To delete data
     *
     * @param string $table_name
     * @param array  $where_values
     *
     * @return boolean
     */
    public function delete( string $table_name, array $where_values ): bool {
        $where_placeholders = [];
        foreach ( $where_values as $key => $value ) {
            $where_placeholders[] = "$key=:$key";
        }
        $where_placeholders = implode( ' AND ', $where_placeholders );

        $delete = $this->conn->prepare( "DELETE FROM $table_name WHERE $where_placeholders" );

        $delete->execute( $where_values );
        return boolval($delete->rowCount());
    }
}