<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rventas extends Model
{
    
    // dateFilter
    public function scopeDateFilter( $query, $from_date=null, $to_date=null ){

        if( !empty( $from_date ) ){
            $from_date = date('Y-m-d 00:00:01', strtotime( $from_date ) );

            $to_date = ( !empty( $to_date ) )? date('Y-m-d 23:59:59', strtotime( $to_date ) ) : date('Y-m-d 23:59:59' );

            $query->whereBetween( 'fecha_creacion', [ $from_date, $to_date ] );
        }

        return $query;
    }
}