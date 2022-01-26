<?php
declare(strict_types = 1);

namespace Chaos\QualitiesOfLife\CommandExecutor;

use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\World;

class TimeExecutor implements CommandExecutor {

	private const TIMES = [
		"day" => 6000,
		"night" => 14000,
		"midnight" => 18000,
        "dusk" => 12200,
        "dawn" => 23200
	];

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
		if(isset($args[0])){
			$world = Server::getInstance()->getWorldManager()->getWorldByName($args[0]);
			if($world === null){
				$sender->sendMessage("§cworld not found");
				return true;
			}
		}elseif($sender instanceof Player){
			$world = $sender->getWorld();
		}else{
			$sender->sendMessage("... world -> §cmissing");
			return true;
		}

		$world->setTime(self::TIMES[$command->getName()]);
		return true;
	}
}
