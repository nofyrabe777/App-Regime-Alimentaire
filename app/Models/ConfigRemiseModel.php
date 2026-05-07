<?php
namespace App\Models;

use CodeIgniter\Model;

class ConfigRemiseModel extends Model{
    protected $table='configuration_remise';
    protected $primaryKey = 'id_config';
    protected $allowedFields = [
        'pourcentage_remise',
        'prix_option_gold'
    ];

}