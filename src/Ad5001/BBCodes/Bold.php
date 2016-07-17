<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\command\CommandSender;

use Ad5001\BBCodes\Main;
use Ad5001\BBCodes\BBCode;



class Bold extends BBCode {
    
    
   public function getTagName() : string { return "b"; }
   

   public function __construct(Main $main) {
        $this->main = $main;
        $this->server = $main->getServer();
    }
    
    
    
    public function parse(string $msg) : string {
        return C::BOLD . $msg . C::RESET;
    }
    
    
    
    public function takeParam() : array { return []; }
    
    
    
    public function canUse(CommandSender $sender) : bool {
        return $sender->hasPermission("bbcodes.use." . $this->main->getConfig()->get("BoldPerm"));
    }
    
    
    
    public function getDescription() : string {
        return "Make a message §lBold§r.";
    }
}