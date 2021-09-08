# KygekExamplePlugin

[![Poggit CI](https://poggit.pmmp.io/ci.shield/KygekTeam/KygekExamplePlugin/~)](https://poggit.pmmp.io/ci/KygekTeam/KygekExamplePlugin/~)
[![Discord](https://img.shields.io/discord/735439472992321587.svg?label=&logo=discord&logoColor=ffffff&color=7389D8&labelColor=6A7EC2)](https://discord.gg/CXtqUZv)

**PM4 BRANCH WARNING: This plugin branch is currently under development. There might be some major bugs. If you found one, please [submit an issue](https://github.com/KygekTeam/KygekExamplePlugin/issues).**

An example PocketMine-MP plugin to show coding styles of KygekTeam plugins and as example plugin for PocketMine-MP. This plugin will never be released on Poggit as it only serves as an example plugin.

## ❓ Why This Plugin Exists

This plugin serves as an example plugin for PocketMine-MP in addition to PMMP's PocketMine-MP [example plugin](https://github.com/pmmp/ExamplePlugin). This plugin also serves as an example of the application of KygekTeam plugin coding standards (for more information, visit the [PHP Coding Standards](https://docs.kygekteam.org/coding-standards/php.html) page in KygekTeam Docs).

## ❔ What Does This Plugin Do

This example plugin broadcasts a message to the server whenever a player chats with a delay by utilizing PocketMine-MP delayed task. Broadcasting can be enabled or disabled through the `/exampleplugin` command or directly in the `config.yml` file. The broadcasted message and delay can also configured through the `config.yml` file. The configuration file gets reloaded whenever a player chats regardless of the enable broadcasting settings.

## ✅ Features

- Uses the KygekTeam [PHP Coding Standards](https://docs.kygekteam.org/coding-standards/php.html) syntax
- Enable or disable through the `/exampleplugin` command or directly in the `config.yml` file
- Broadcast prefix can be enabled or disabled through the `config.yml` file
- Configurable broadcast message and delay
- Configuration file gets updated automatically when a newer configuration file is available

## 🔧 Installation

Follow the steps below if you want to test this plugin in your PocketMine-MP server:

1. 🔽 Download the latest version from GitHub Releases or Poggit CI below:
   - Stable version (Recommended for most users): [Latest](https://github.com/KygekTeam/KygekExamplePlugin/releases/latest) | [All releases](https://github.com/KygekTeam/KygekExamplePlugin/releases)
   - Build version (Only recommended for advanced users): [Poggit CI](https://poggit.pmmp.io/ci/KygekTeam/KygekExamplePlugin/~)
2. 📁 Drop the downloaded `KygekExamplePlugin.phar` plugin file into your PocketMine-MP server's `plugins` directory.
3. 🔄 Restart your server and you're ready to test the plugin!

## 🔐 Commands & Permissions

| Command | Description | Permission | Default | Aliases |
| --- | --- | --- | --- | --- |
| `/exampleplugin` | Command to enable or disable broadcast message when a player chats | `kygekexampleplugin.cmd` | `true` | `/expl`, `/ep` |

## 🧾 Planned Features

- PM4 support
- More beginner-friendly code
- Comments to explain what the plugin does for beginners

You can request for a feature to be added in a future update [here](https://github.com/KygekTeam/KygekExamplePlugin/issues)!

## ➕ Additional Info

KygekExamplePlugin is an example plugin by KygekTeam and licensed under **GPL-3.0**.

- Join our Discord server [here](https://discord.gg/CXtqUZv) for latest news and support from KygekTeam.
- If you found bugs or want to give suggestions, please visit [here](https://github.com/KygekTeam/KygekExamplePlugin/issues) or join our Discord server.
- We accept all contributions! If you want to contribute please make a pull request in [here](https://github.com/KygekTeam/KygekExamplePlugin/pulls).
