<?php

namespace Backend\framework\adaptors\http;

use Backend\application\MotorbikeCreate;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Input;

/**
 *
 * Created by PhpStorm.
 * User: monsiuer_alireza
 * Date: 8/23/17
 * Time: 12:47 PM
 *
 */

/**
 * Class Gateway
 * @package framework\adaptors\http
 */
class Gateway
{
    use DispatchesJobs;

    /**
     * @return string
     */
    public function index()
    {
        return 'home page';
    }

    /**
     * @return mixed
     */
    public function show()
    {
        $model = \App\ReadMotorBikeModel::paginate(5);
        return $model->toJson();
    }

    /**
     *
     * unfortunately php do not support polymorphism
     * very very simple
     * nested if are not okay here ! I know
     * @param $filter
     *
     */
    public function show_filter()
    {
        /*
         * this must be replace with decorator
         */
        $filters = ['color', 'weight', 'model'];
        $filter = Input::get('filter');
        $order = Input::get('order');
        $dir = Input::get('dir');

        $model = \App\ReadMotorBikeModel::where(function ($q) use ($filters, $filter) {
            foreach ($filter as $key => $value) {
                if (!in_array($key, $filters))
                    continue;
                $q->where($key, $value);
            }
        });

        /*
         * this must be replace with decorator
         */
        if ($dir != 'desc' && $dir != 'asc')
            $dir = 'desc';
        if (in_array($order, $filters))
            $model->orderBy($order, $dir);

        return $model->paginate(5)->toJson();
    }


    /**
     * @return bool
     */
    public function create()
    {
        return $this->dispatch(
            new MotorbikeCreate()
        );

    }


}