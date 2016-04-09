<?php
namespace MyPlot\subcommand;

use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class UpdateSubCommand extends SubCommand
{
    public function canUse(CommandSender $sender) {
        return ($sender instanceof Player) and $sender->hasPermission("myplot.command.update");
    }

    public function execute(CommandSender $sender, array $args) {
    $this->getLogger()->info(TextFormat::GREEN."Checking for any updates...");
				$lst = Utils::getURL("https://raw.githubusercontent.com/wiez/MyPlot/master/plugin.yml");
				
				$dsc = \yaml_parse($lst);
				
				$description = $this->getDescription();
				if($description->getVersion() !== $dsc['version']){
					$this->getLogger()->info(TextFormat::YELLOW."MyPlot v".$dsc["version"]." has been released. Please download the latest version here:\n".TextFormat::GOLD."http://github.com/wiez/MyPlot/releases");
				}else{
					$this->getLogger()->info(TextFormat::GREEN."Your version of MyPlot is up-to-date! No update is required.");
				}
			}
}
