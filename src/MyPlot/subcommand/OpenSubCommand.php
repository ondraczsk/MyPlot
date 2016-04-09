<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class OpenSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return ($sender instanceof Player) and $sender->hasPermission("myplot.command.open");
    }

    public function execute(CommandSender $sender, array $args) {
    
        $player = $sender->getServer()->getPlayer($sender->getName());
        $plot = $this->getPlugin()->getPlotByPosition($player->getPosition());
        if ($plot === null) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("notinplot"));
            return true;
        }
        if ($plot->owner !== $sender->getName() and !$sender->hasPermission("myplot.admin.open")) {
            $sender->sendMessage(TextFormat::RED . $this->translateString("notowner"));
            return true;
        }
        if ($plot->isOpen($plot) == "True") {
            $sender->sendMessage($this->translateString("open.already"));
            return true;
        }
        if ($this->getPlugin()->getProvider()->savePlot($plot)) {
            $sender->sendMessage($this->translateString("open.success"));
            $plot->open = "True";
        } else {
            $sender->sendMessage(TextFormat::RED . $this->translateString("error"));
        }
        return true;
    }
}
