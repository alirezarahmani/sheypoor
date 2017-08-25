<?php

namespace Backend\domain\model\aggregate;

use Illuminate\Database\Eloquent\Model;


use ValueObjects\Money\Currency;
use ValueObjects\Money\CurrencyCode;
use ValueObjects\Money\Money;
use ValueObjects\Number\Integer;

class  motorbike extends Model implements  \Backend\domain\model\aggregate\aggregateroot
{
    protected $table = 'motor_bike';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'model', 'color', 'weight', 'price'];



    public function __construct(int $id,$attr=false)
    {
        parent::__construct([]);


        $this->id =$id;
    }


    public function create(array $attr = [])
    {

        if(is_array($attr) && !empty($attr))
        {

            $this->price = new Money( new Integer($attr['price']),new Currency(CurrencyCode::getByName('USD')));
            $this->price = $this->price->getAmount();
            $this->check_model($attr['model']);
            $this->model = $attr['model'];
            $this->color = $attr['color'];

            if($attr['weight'] <= 10000 && $attr['weight'] >= 1000 )
            {
                Throw new \Exception('wrong weight ');
            }
            $this->weight = $attr['weight'];
            return true;
        }

        Throw new \Exception('wrong inputs');


    }

    public function id()
    {
        return $this->id;
    }

    public function record($event)
    {

    }

    public function release()
    {

    }

    private function check_model($model)
    {
        /*
         * query database to fetch all models by value object here is simple filed array instead
         */
        $md =['2000_plus' , '1500-metal'];

        if(in_array($model,$md))
        {
         return true;
        }
        Throw new \Exception('wrong model ');

    }

}

