<?php
declare(strict_types = 1);

namespace Chaos\QualitiesOfLife;

use pocketmine\event\player\PlayerEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\Listener;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;

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
}
