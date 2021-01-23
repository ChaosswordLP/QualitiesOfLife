<?php
declare(strict_types = 1);

namespace Chaos\QualitiesOfLife\CommandExecutor;

use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\world\particle\DustParticle;
use pocketmine\color\Color as Colour;

class ParticleCircleExecutor implements CommandExecutor {

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
		if(!($sender instanceof Player)){
			$sender->sendMessage("§cFuck off");
			return true;
		}

		$particle = new DustParticle(new Colour(255, 182, 193));
		$pos = $sender->getPosition();
		$originalAmount = max(1, (int) ($args[1] ?? 12));
		$originalRadius = max(0.0, (float) ($args[0] ?? 2.0));
		$circleAmount = max(1, (float) ($args[2] ?? 1));

		for($stuff = M_PI / 2; $stuff >= 0; $stuff -= M_PI / $circleAmount){
			$sin = sin($stuff);
			$radius = $sin * $originalRadius;
			$dY = cos($stuff) * $originalRadius;

			$amount = (int) ($sin * $originalAmount);
			if($amount === 0){
				continue;
			}
			$step = 2 * M_PI / $amount;

			for($i = 0; $i < $amount / 2; $i++){
				$angle = $i * $step;
				$dX = sin($angle) * $radius;
				$dZ = cos($angle) * $radius;
				$sender->getWorld()->addParticle($pos->add($dX, $dY, $dZ), $particle);
				$sender->getWorld()->addParticle($pos->add($dX, -$dY, $dZ), $particle);
			}
		}
		return true;
	}
}
