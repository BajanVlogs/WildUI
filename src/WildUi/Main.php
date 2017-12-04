<?php

namespace WildUi;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\entity\Effect;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener {
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TextFormat::GREEN . "WildUI for RebirthPE.");
    }
	
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "WildUI disabled.");
    }
	
    public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args) : bool {
		
		switch($cmd->getName()){
		
			case "wildui":
				if($sender instanceof Player) {
					
					// START - JoeJoe Dependency
					$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
					
					if($api === null || $api->isDisabled()){
					
					}
					
					$form = $api->createSimpleForm(function (Player $sender, array $data){
					$result = $data[0];
					
					if($result === null){
						
					}
						switch($result){
							
							case 0:
								// Wild
								// If Wild is for op command use this so console will tp player
								$this->getServer()->dispatchCommand(new ConsoleCommandSender, "wild " . $sender . " ");
								
								// If wild player is for everybody use this
								//$command = "wild ";
								//$this->getServer()->getCommandMap()->dispatch($sender, $command);
								break;
								
						}
					
					});
					
					$form->setTitle("RebirthPE WildUI Screen");
					$form->setContent("Please choose your destination.");
					$form->addButton(TextFormat::BOLD . "Wild");	
					$form->sendToPlayer($sender);
					// END
					
				}
				else{
					$sender->sendMessage(TextFormat::RED . "Use this Command in-game.");
					return true;
				}
			break;
			
			
		}
		return true;
    }
	
}
