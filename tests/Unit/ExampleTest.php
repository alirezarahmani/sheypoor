<?php

namespace Tests\Unit;

use Backend\domain\model\aggregate\motorbike;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    public function index_gateway_should_return_jsonTest()
    {
        $this->get('admin/index')
            ->seeJson();
    }

    public function show_gateway_should_return_jsonTest()
    {
        $this->get('admin/show')
            ->seeJson();
    }

    /**
     * @expectedException \Exception
     */
    public function must_return_exceptionTest()
    {
       $mb = new  motorbike(0);
       $mb->create();
    }

    /**
     * @expectedException \Exception
     */
    public function must_return_exception_wrong_weightTest()
    {
        $mb = new  motorbike(0);
        $mb->create(['price'=>120,'model'=>'1500-metal','color'=>'blue','weight'=>10]);
    }

    /**
     * @expectedException \Exception
     */
    public function must_return_exception_wrong_modelTest()
    {
        $mb = new  motorbike(0);
        $mb->create(['price'=>120,'model'=>'150etal','color'=>'blue','weight'=>10]);
    }


    public function must_return_trueTest()
    {
       $mb = new  motorbike(0);
       $this->assertTrue($mb->create(['price'=>120,'model'=>'1500-metal','color'=>'blue','weight'=>10000]));
    }


}
