<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Bus\Handlers\Commands\Metric;

use App\Bus\Commands\Metric\RemoveMetricPointCommand;
use App\Bus\Events\Metric\MetricPointWasRemovedEvent;
use App\Models\Metric;
use Illuminate\Contracts\Auth\Guard;

class RemoveMetricPointCommandHandler
{
    /**
     * The authentication guard instance.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new remove metric point command handler instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle the remove metric point command.
     *
     * @param \App\Bus\Commands\Metric\RemoveMetricPointCommand $command
     *
     * @return void
     */
    public function handle(RemoveMetricPointCommand $command)
    {
        $metricPoint = $command->metricPoint;

        event(new MetricPointWasRemovedEvent($this->auth->user(), $metricPoint));

        $metricPoint->delete();
    }
}
