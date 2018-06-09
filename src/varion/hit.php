<?php

namespace varion;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\Level;
use pocketmine\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerJoinEvent;

class hit extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("§b HitModifier enabled by Varion.");
        @mkdir($this->getDataFolder());
        $this->slide = new Config($this->getDataFolder(). "config.yml",Config::YAML,array(
            "kb-modifier" => true,
            "kb-number" => 0.2 // this will change the knockback, Emis is gay.
        ));

    }

    public function onDisable(){
        $this->getLogger()->info("§b HitModifier disabled.");
    }

    public function onJoin(PlayerJoinEvent $join){
        $pl = $join->getPlayer();
        $n = $pl->getName();
        $pl->sendPopup("§7[§3ItaSkyGames§7]§b Ciao $n §7");
    }
    public function onDamage(EntityDamageEvent $ev){
        if($ev instanceof EntityDamageByEntityEvent){
            $ev->setKnockBack($this->slide->get("kb-number"));
        }
    }
}