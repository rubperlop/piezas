<?php

namespace FormacionAPP;

use PDOStatement;

class Pieza {
    const TABLE = 'pieza';

    private Consulta $consulta;

    public function __construct() {
        $this->consulta = new Consulta();
    }

    /**
     * @param $search
     * @param $field
     *
     * @return false|PDOStatement|void
     */
    public function search( $search, $field ) {
        $rows = [];
        if ( $search != "" ) {
            $rows = $this->consulta->consult( $field, self::TABLE, $search );
        }

        return $rows;
    }

    /**
     * @param $codpie
     * @param $nompie
     * @param $color
     * @param $peso
     * @param $ciudad
     *
     * @return string
     */
    public function insert( $codpie, $nompie, $color, $peso, $ciudad ): string {
        if ( ! $this->validate_fields( $codpie, $nompie, $peso, true ) ) {
            return 'The provided fields are not valid';
        };

        try {
            $this->consulta->insert( self::TABLE, [ 'codpie', 'nompie', 'color', 'peso', 'ciudad' ], [
                $codpie,
                $nompie,
                $color,
                (float) $peso,
                $ciudad,
            ] );
        } catch ( PDOException $e ) {
            $message = $e->getMessage();
        }

        return $message ?? 'Pieza inserted succesfully';
    }

    /**
     * @param string $codpie
     * @param string $nompie
     * @param float  $peso
     * @param string $color
     * @param string $ciudad
     *
     * @return string
     */
    public function update( string $codpie, string $nompie, float $peso, string $color, string $ciudad ): string {
        if ( ! $this->validate_fields( $codpie, $nompie, $peso ) ) {
            return 'The provided fields are not valid';
        };

        try {
            $this->consulta->update( self::TABLE,
                [ 'nompie' => $nompie, 'peso' => $peso, 'color' => $color, 'ciudad' => $ciudad, ],
                [ 'codpie' => $codpie ]
            );
        } catch ( PDOException $e ) {
            $message = $e->getMessage();
        }

        return $message ?? 'Pieza updated succesfully';
    }

    /**
     * @param $codpie
     *
     * @return string
     */
    public function delete( string $codpie ): string {
        if ( empty ( $codpie ) ) {
            return 'The provided fields are not valid';
        };

        try {
           $result = $this->consulta->delete( self::TABLE, [ "codpie" => $codpie ] );
        } catch ( PDOException $e ) {
            $message = $e->getMessage();
        }

        return $message ?? ( $result  ? 'Pieza deleted succesfully' : 'Pieza was not deleted');

    }

    /**
     * @param string $codpie
     * @param string $nompie
     * @param float  $peso
     * @param bool   $insert
     *
     * @return bool
     */
    private function validate_fields( string $codpie, string $nompie, float $peso, bool $insert = false ): bool {
        if ( empty( $codpie ) ) {
            return false;
        }

        if ( empty( $nompie ) ) {
            return false;
        }

        if ( $peso <= 0 || $peso > 100 ) {
            return false;
        }

        if ( $insert && ! empty( $this->search( $codpie, 'codpie' ) ) ) {
            return false;
        }

        return true;
    }
}