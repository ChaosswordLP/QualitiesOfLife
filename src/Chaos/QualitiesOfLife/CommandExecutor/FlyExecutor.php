<?php
declare(strict_types = 1);

namespace Chaos\QualitiesOfLife\CommandExecutor;

use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;

class FlyExecutor implements CommandExecutor {

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
			if(count($args) > 0) {
				$player = $sender->getServer()->getPlayerByPrefix($args[0]);
				if($player instanceof Player){
					if($player != isCreative()) {
					if($player->getAllowFlight() === false) {
						$player->setAllowFlight(true);
						$player->setFlying(true);
					}else{
						$player->setAllowFlight(false);
						$player->setFlying(false);
					}
				}
			}else{
				$sender->sendMessage($args[0]." is not online");
			}
		}else{
			if($sender instanceof Player){
				if($sender->getAllowFlight() === false) {
					$sender->setAllowFlight(true);
					$sender->setFlying(true);
				}else{
					$sender->setAllowFlight(false);
					$sender->setFlying(false);
				}
			}else{
				$sender->sendMessage("Fuck off");
			}
		}
	return true;
	}
}
///UHGH
