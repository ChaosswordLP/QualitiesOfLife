<?php
declare(strict_types = 1);

namespace Chaos\QualitiesOfLife\CommandExecutor;

use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\GameMode;
use pocketmine\player\Player;

class GamemodeSurvivalExecutor implements CommandExecutor {

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
		if(count($args) > 0) {
			$player = $sender->getServer()->getPlayerByPrefix($args[0]);
			if($player instanceof Player){
				if($player->getGamemode() === GameMode::SURVIVAL()) {
					return true;
				}else{
					$player->setGamemode(GameMode::SURVIVAL());
				}
			}else{
				$sender->sendMessage($args[0]." §cis not online");
			}
		}else{
			if($sender instanceof Player){
				if($sender->getGamemode() === GameMode::SURVIVAL()){
					return true;
				}else{
					$sender->setGamemode(GameMode::SURVIVAL());
				}
			}else{
				$sender->sendMessage("§cFuck off");
			}
		}
		return true;
	}
}
