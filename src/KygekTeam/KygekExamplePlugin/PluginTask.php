<?php

/*
 * Example plugin to show coding styles and templates of KygekTeam plugins
 * Copyright (C) 2021-2022 KygekTeam
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace KygekTeam\KygekExamplePlugin;

use pocketmine\scheduler\Task;
use pocketmine\Server;

class PluginTask extends Task {

    // Creates class properties from instantiation parameters (PHP 8.0 and up)
    public function __construct(
        private string $message,
        private bool $prefixEnabled,
        private int|float $delay
    ) {}

    // Code to run when the task gets invoked
    public function onRun() : void {
        // Replaces the $seconds variable with the delay of the task in seconds
        // $this->delay is in ticks, so we need to convert it to seconds by dividing it by 20
        $message = str_ireplace("\$seconds", strval($this->delay / 20), $this->message);
        // Broadcasts the message to the entire server
        Server::getInstance()->broadcastMessage(($this->prefixEnabled ? ExamplePlugin::PREFIX : "") . $message);
    }

}