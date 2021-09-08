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

use KygekTeam\KtpmplCfs\KtpmplCfs;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class ExamplePlugin extends PluginBase implements Listener {

    private const IS_DEV = true;

    public const PREFIX = TF::AQUA . "[KygekExamplePlugin] " . TF::RESET;
    public const INFO = TF::GREEN;

    private const COMMAND = "exampleplugin";

    private bool $isEnabled;

    public function onEnable() : void {
        $this->saveDefaultConfig();
        /** @phpstan-ignore-next-line */
        if (self::IS_DEV) {
            $this->getLogger()->warning("This plugin is running on a development version. There might be some major bugs. If you found one, please submit an issue in https://github.com/KygekTeam/KygekExamplePlugin/issues.");
        }
        KtpmplCfs::checkConfig($this, "2.0");

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->isEnabled = $this->getConfig()->get("enabled", true);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
        if ($command->getName() !== self::COMMAND) return true;

        if ($this->isEnabled) {
            $this->getConfig()->set("enabled", false);
            $this->getConfig()->save();
            $this->isEnabled = false;

            $sender->sendMessage(self::PREFIX . self::INFO . "Successfully disabled KygekExamplePlugin broadcast");
        } else {
            $this->getConfig()->set("enabled", true);
            $this->getConfig()->save();
            $this->isEnabled = true;

            $sender->sendMessage(self::PREFIX . self::INFO . "Successfully enabled KygekExamplePlugin broadcast");
        }
        return true;
    }

    /**
     * @priority HIGHEST
     */
    public function onChat(PlayerChatEvent $event) {
        $this->getConfig()->reload();
        $this->isEnabled = $this->getConfig()->get("enabled", true);
        if ($event->isCancelled() || !$this->isEnabled) return;

        $message = $this->getConfig()->get("message", "");
        $message = empty($message) ? self::INFO . "Player \$player chatted \$seconds second(s) ago" : TF::colorize($message);
        $message = str_ireplace("\$player", $event->getPlayer()->getName(), $message);
        $prefixEnabled = $this->getConfig()->get("use-prefix", true);
        $delay = $this->getConfig()->get("delay", 1) * 20;

        $this->getScheduler()->scheduleDelayedTask(new PluginTask($message, $prefixEnabled, $delay), (int) $delay);
    }

}