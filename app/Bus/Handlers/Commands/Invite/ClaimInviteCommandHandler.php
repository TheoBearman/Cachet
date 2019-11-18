<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Bus\Handlers\Commands\Invite;

use App\Bus\Commands\Invite\ClaimInviteCommand;
use App\Bus\Events\Invite\InviteWasClaimedEvent;
use Carbon\Carbon;

class ClaimInviteCommandHandler
{
    /**
     * Handle the claim invite command.
     *
     * @param \App\Bus\Commands\Invite\ClaimInviteCommand $command
     *
     * @return void
     */
    public function handle(ClaimInviteCommand $command)
    {
        $invite = $command->invite;

        $invite->update(['claimed_at' => Carbon::now()]);

        event(new InviteWasClaimedEvent($invite));
    }
}
