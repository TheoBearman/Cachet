<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Bus\Events\Component;

use App\Bus\Events\ActionInterface;
use App\Models\Component;
use App\Models\User;

/**
 * This is the component status was changed event.
 *
 * @author James Brooks <james@alt-three.com>
 */
final class ComponentStatusWasChangedEvent implements ActionInterface, ComponentEventInterface
{
    /**
     * The user who changed the component.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The component that was changed.
     *
     * @var \App\Models\Component
     */
    public $component;

    /**
     * The original status of the component.
     *
     * @var int
     */
    public $original_status;

    /**
     * The new status of the component.
     *
     * @var int
     */
    public $new_status;

    /**
     * If silent, we won't notify.
     *
     * @var bool
     */
    public $silent;

    /**
     * Create a new component was updated event instance.
     *
     * @param \App\Models\User      $user
     * @param \App\Models\Component $component
     * @param int                               $original_status
     * @param int                               $new_status
     * @param bool                              $silent
     *
     * @return void
     */
    public function __construct(User $user, Component $component, $original_status, $new_status, $silent)
    {
        $this->user = $user;
        $this->component = $component;
        $this->original_status = $original_status;
        $this->new_status = $new_status;
        $this->silent = $silent;
    }

    /**
     * Get the event description.
     *
     * @return string
     */
    public function __toString()
    {
        return 'Component status was changed.';
    }

    /**
     * Get the event action.
     *
     * @return array
     */
    public function getAction()
    {
        return [
            'user'        => $this->user,
            'description' => (string) $this,
        ];
    }
}
