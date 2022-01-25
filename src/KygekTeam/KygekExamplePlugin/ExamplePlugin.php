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

use KygekTeam\KtpmplCfs\KtpmplCfs;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class ExamplePlugin extends PluginBase implements Listener {

    private const IS_DEV = false;

    public const PREFIX = TF::AQUA . "[KygekExamplePlugin] " . TF::RESET;
    public const INFO = TF::GREEN;

    private const COMMAND = "exampleplugin";

    private bool $isEnabled;

    protected function onEnable() : void {
        // Ktpmpl-cfs virion (https://github.com/KygekTeam/ktpmpl-cfs)
        $ktpmplcfs = new KtpmplCfs($this);
        /** @phpstan-ignore-next-line */
        if (self::IS_DEV) {
            $ktpmplcfs->warnDevelopmentVersion();
        }

        // Copies config.yml from resources/config.yml to the plugin data folder if doesn't exist
        $this->saveDefaultConfig();
        $ktpmplcfs->checkConfig("2.1");

        // Registers event listener methods (in this plugin there's onChat())
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        // Gets the "enabled" key from config.yml
        $this->isEnabled = $this->getConfig()->get("enabled", true);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
        // Checks if the executed command name is "exampleplugin"
        if ($command->getName() !== self::COMMAND) return true;

        if ($this->isEnabled) {
            // Modifies the "enabled" key in the config.yml, and saves the changes
            $this->getConfig()->set("enabled", false);
            $this->getConfig()->save();
            $this->isEnabled = false;

            // Sends a message to the command sender
            $sender->sendMessage(self::PREFIX . self::INFO . "Successfully disabled KygekExamplePlugin broadcast");
        } else {
            $this->getConfig()->set("enabled", true);
            $this->getConfig()->save();
            $this->isEnabled = true;

            $sender->sendMessage(self::PREFIX . self::INFO . "Successfully enabled KygekExamplePlugin broadcast");
        }

        // Returning "true" means the command runs successfully
        return true;
    }

    // Sets the event listener priority (HIGHEST means the listener may be invoked last)
    /**
     * @priority HIGHEST
     */
    public function onChat(PlayerChatEvent $event) {
        // Reloads the config.yml contents in the cache from the file
        $this->getConfig()->reload();
        $this->isEnabled = $this->getConfig()->get("enabled", true);
        // Don't run if the event has been cancelled or is not enabled
        if ($event->isCancelled() || !$this->isEnabled) return;

        $message = $this->getConfig()->get("message", "");
        $message = empty($message) ? self::INFO . "Player \$player chatted \$seconds second(s) ago" : TF::colorize($message);
        // Replaces the $player variable with the name of the event player
        $message = str_ireplace("\$player", $event->getPlayer()->getName(), $message);
        $prefixEnabled = $this->getConfig()->get("use-prefix", true);
        // Gets the delay from config.yml and multiplies it by 20 (1 second = 20 ticks; converts seconds to ticks)
        $delay = $this->getConfig()->get("delay", 1) * 20;

        // Submits a new delayed task to run the PluginTask class
        $this->getScheduler()->scheduleDelayedTask(new PluginTask($message, $prefixEnabled, $delay), (int) $delay);
    }

}
