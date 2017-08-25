<?php
/**
 * Created by PhpStorm.
 * User: monsiuer_alireza
 * Date: 8/25/17
 * Time: 11:15 AM
 */

namespace Backend\framework\adaptors\persistance;

use Backend\domain\model\aggregate\motorbike as MotorBike ;
use Backend\framework\ports\persistanceinterface;

class  motorbikerepository implements \Backend\domain\irepository , persistanceinterface
{


    public function create($input)
    {
        $mb = new MotorBike(0);
        $mb->create($input);
        $mb->save();
        return [];
    }

}