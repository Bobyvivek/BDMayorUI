<?php

namespace BDMayorUI\BobyDev;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use jojoe77777\FormAPI\SimpleForm;

class UI extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getLogger()->info(TextFormat::GREEN . "MayorUI By BhawaniSingh Enabled ✅");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "rules") {
            if ($sender instanceof Player) {
                $this->showRulesForm($sender);
            } else {
                $sender->sendMessage(TextFormat::RED . "Use this command in-game.");
            }
            return true;
        }
        return false;
    }

    private function showRulesForm(Player $player): void {
        $form = new SimpleForm(function (Player $player, ?int $data): void {
            if ($data === null) {
                // Form closed or no action taken.
                return;
            }

            if ($data === 0) {
                $player->sendMessage(TextFormat::GREEN . "Thank you for reading the rules!");
            }
        });

        $name = $player->getName();
        $form->setTitle(TextFormat::BOLD . TextFormat::GOLD . "RULES & INFO");
        $form->setContent(
            TextFormat::LIGHT_PURPLE . "Hello, " . TextFormat::AQUA . $name . "\n\n" .
            TextFormat::BLUE . "Read these rules before playing:\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Don't use Toolbox\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Join our Discord server\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Report bugs in Discord\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Don't spam in chat\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Nether and End coming soon\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Put items one by one in crafting table\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Use /recipes for custom recipes\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Vote for OP rewards\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Don't abuse anyone\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Live like a family in the server\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Use fast-travel to explore\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Type /kit for free kits\n" .
            TextFormat::GREEN . "» " . TextFormat::GRAY . "Purchase ranks via Discord\n\n" .
            TextFormat::RED . "Follow these rules and enjoy the server!"
        );
        $form->addButton(TextFormat::BOLD . TextFormat::YELLOW . "OK\n" . TextFormat::BLUE . "»» " . TextFormat::RESET . TextFormat::AQUA . "Tap to confirm", 0, "textures/ui/realms_slot_check");
        $form->sendToPlayer($player);
    }
}