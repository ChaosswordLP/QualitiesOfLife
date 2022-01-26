<?php
declare(strict_types = 1);

namespace Chaos\QualitiesOfLife;

use Chaos\QualitiesOfLife\CommandExecutor\GamemodeSurvivalExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\GamemodeCreativeExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\GamemodeAdventureExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\GamemodeSpectatorExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\HealExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\HungerExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\FlyExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\FeedExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\ParticleCircleExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\SpeedExecutor;
use Chaos\QualitiesOfLife\CommandExecutor\TimeExecutor;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase {

	protected function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
		
		$this->getServer()->getCommandMap()->getCommand("heal")->setExecutor(new HealExecutor());
		$this->getServer()->getCommandMap()->getCommand("fly")->setExecutor(new FlyExecutor());
		$this->getServer()->getCommandMap()->getCommand("feed")->setExecutor(new FeedExecutor());
		$this->getServer()->getCommandMap()->getCommand("hunger")->setExecutor(new HungerExecutor());
		$this->getServer()->getCommandMap()->getCommand("s")->setExecutor(new GamemodeSurvivalExecutor());
		$this->getServer()->getCommandMap()->getCommand("c")->setExecutor(new GamemodeCreativeExecutor());
		$this->getServer()->getCommandMap()->getCommand("a")->setExecutor(new GamemodeAdventureExecutor());
		$this->getServer()->getCommandMap()->getCommand("v")->setExecutor(new GamemodeSpectatorExecutor());
		$timeExecutor = new TimeExecutor();
		$this->getServer()->getCommandMap()->getCommand("day")->setExecutor($timeExecutor);
		$this->getServer()->getCommandMap()->getCommand("night")->setExecutor($timeExecutor);
		$this->getServer()->getCommandMap()->getCommand("midnight")->setExecutor($timeExecutor);
        $this->getServer()->getCommandMap()->getCommand("dawn")->setExecutor($timeExecutor);
        $this->getServer()->getCommandMap()->getCommand("dusk")->setExecutor($timeExecutor);
		$this->getServer()->getCommandMap()->getCommand("circle")->setExecutor(new ParticleCircleExecutor());
		$this->getServer()->getCommandMap()->getCommand("speed")->setExecutor(new SpeedExecutor());

	}
}
