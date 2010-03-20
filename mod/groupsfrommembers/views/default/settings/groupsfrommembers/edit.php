<?php
/*
    This file is part of of the groups-invite-any plugin.

    Foobar is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Foobar is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with groups-invite-any.  If not, see <http://www.gnu.org/licenses/>.
*/
?>

<p><?php echo elgg_echo('groupsfrommembers:maxusers');?>:<br />
    <?php echo elgg_view('input/text',
        array('internalname' => 'params[maxusers]', 'value' => $vars['entity']->maxusers));?></p>