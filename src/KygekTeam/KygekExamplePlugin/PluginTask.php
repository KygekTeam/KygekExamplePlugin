<?php

/*
 * Example plugin to show coding styles and templates of KygekTeam plugins
 * Copyright (C) 2021 KygekTeam
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

    public function __construct(
        private string $message,
        private bool $prefixEnabled,
        private int|float $delay
    ) {}

    public function onRun(int $currentTick) {
        $message = str_ireplace("\$seconds", strval($this->delay / 20), $this->message);
        Server::getInstance()->broadcastMessage(($this->prefixEnabled ? ExamplePlugin::PREFIX : "") . $message);
    }

}