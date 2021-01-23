<?php
declare(strict_types = 1);

namespace Chaos\QualitiesOfLife\CommandExecutor;

use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\entity\Attribute;

class SpeedExecutor implements CommandExecutor {

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
		$player = $sender;
		if(!($sender instanceof Player)){
			$sender->sendMessage("§cFuck Off");
			return true;
		}
		if(isset($args[1])){
			if(($player = $sender->getServer()->getPlayerByPrefix($args[1])) instanceof Player){
				$value = (float) $args[0];
				$player->getAttributeMap()->get(Attribute::MOVEMENT_SPEED)->setValue($value);
				return true;
			}else{
				$sender->sendMessage($args[1]." §cis not online");
				return true;
			}
		}
		if(isset($args[0])){
			if((int) $args[0] >= 0){
				$value = (float) $args[0];
				$player->getAttributeMap()->get(Attribute::MOVEMENT_SPEED)->setValue($value);
			}else{
				$player->sendMessage("§cFuck Off Value is negative");
			}
		}elseif(!isset($args[0])){
			$player->getAttributeMap()->get(Attribute::MOVEMENT_SPEED)->resetToDefault();
		}
		return true;
	}
}
