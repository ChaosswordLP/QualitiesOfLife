<?php
declare(strict_types = 1);

namespace Chaos\QualitiesOfLife;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\event\Listener;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;
use pocketmine\world\particle\DustParticle;
use pocketmine\world\particle\HeartParticle;
use pocketmine\color\Color as Colour;

class EventListener implements Listener{
	public function onPlayerJoin(PlayerJoinEvent $event): void{
		$pC = new GameRulesChangedPacket();
		$event->getPlayer()->getNetworkSession()->sendDataPacket($pC);
		$pC->gameRules['showcoordinates'] = new BoolGameRule(true, true);
		$p = $event->getPlayer()->getName();
		$event->setJoinMessage("§a++$p");
	}
	public function onPlayerQuit(PlayerQuitEvent $event): void{
		$p = $event->getPlayer()->getName();
		$event->setQuitMessage("§c--$p");
	}
	public function onPlayerJump(PlayerJumpEvent $event): void{
		$particle = new HeartParticle();
		$originalAmount = 30;
		$originalRadius = 2.0;
		$circleAmount = 1;

		for($stuff = M_PI / 2; $stuff >= 0; $stuff -= M_PI / $circleAmount){
			$sin = sin($stuff);
			$radius = $sin * $originalRadius;
			$dY = 2;
			$amount = (int) ($sin * $originalAmount);

			if($amount === 0){
				continue;
			} 
			$step = 2 * M_PI / $amount;

			for($i = 0; $i < $amount; $i++){
				$angle = $i * $step;
				$dX = sin($angle) * $radius;
				$dZ = cos($angle) * $radius;
				$event->getPlayer()->getWorld()->addParticle($event->getPlayer()->getPosition()->add($dX, $dY, $dZ), $particle);
			}
		}
	}
	public function onPlayerToggleSneak(PlayerToggleSneakEvent $event): void{
		$sender = $event->getPlayer();
		$particle = new DustParticle(new Colour(255, 182, 193));
		$pos = $sender->getPosition();
		$originalAmount = 60;
		$originalRadius = 5.5;
		$circleAmount = 30;

		for($stuff = M_PI / 2; $stuff >= 0; $stuff -= M_PI / $circleAmount){
			$sin = sin($stuff);
			$radius = $sin * $originalRadius;
			$dY = cos($stuff) * $originalRadius;

			$amount = (int) ($sin * $originalAmount);
			if($amount === 0){
				continue;
			}
			$step = 2 * M_PI / $amount;

			for($i = 0; $i < $amount; $i++){
				$angle = $i * $step;
				$dX = sin($angle) * $radius;
				$dZ = cos($angle) * $radius;
				$event->getPlayer()->getWorld()->addParticle($event->getPlayer()->getPosition()->add($dX, $dY, $dZ), $particle);
				$event->getPlayer()->getWorld()->addParticle($event->getPlayer()->getPosition()->add($dX, -$dY, $dZ), $particle);
			}
		}
	}
}
