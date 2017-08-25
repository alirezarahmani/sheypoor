<?php

namespace Backend\domain\model\aggregate;

interface aggregateroot
{
    /**
     * Return the Aggregate Root identifer
     *
     * @return Identifier
     */
    public function id();

    /**
     * Add an event to the pending events
     *
     * @param $event
     * @return void
     */
    public function record($event);

    /**
     * Release the events
     *
     * @return array
     */
    public function release();
}


?>