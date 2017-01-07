<?php

namespace spc;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
    
    public $nicknames = [];

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }

    public function onJoin(PlayerJoinEvent $e){
        $p = $e->getPlayer();
        if(isset($this->nicknames[strtolower($p->getName())])){
            $name = $this->nicknames[strtolower($p->getName())];
			$p->setGamemode(0);
            $p->sendMessage(TextFormat::GREEN."");
        }
    }
   
    public function onCommand(CommandSender $sender, Command $cmd, $list, array $args){
        switch($cmd){
            case "spectate":
                if(count($args) != 1){
                    $sender->sendMessage(TextFormat::RED."Usage: /spectate on/off");
                    return;
                }
                if(strtolower($args[0]) == "off"){
                    $sender->setGamemode(0);
                    $sender->sendMessage("§bYou are no longer spectating!");
                    return;
                }
                if(strtolower($args[0]) == "on"){
                    $sender->setGamemode(3);
                        $sender->sendMessage(TextFormat::RED."§bYou are now spectating! Use /spectate off to stop spectating");
            break;
       }
    }
}
}
