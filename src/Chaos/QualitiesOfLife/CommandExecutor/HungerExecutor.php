<?php
declare(strict_types = 1);

namespace Chaos\QualitiesOfLife\CommandExecutor;

use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;

class HungerExecutor implements CommandExecutor {

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
		if(count($args) > 0) {
			$player = $sender->getServer()->getPlayerByPrefix($args[0]);
			if($player instanceof Player){
				$player->getHungerManager()->setFood(0);
			}else{
				$sender->sendMessage($args[0]." §cis not online");
			}
		}else{
			if($sender instanceof Player){
				$sender->getHungerManager()->setFood(0);
			}else{
				$sender->sendMessage("Fuck off");
			}
		}
		return true;
	}
}
