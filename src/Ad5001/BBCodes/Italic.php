<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

use Ad5001\BBCodes\Main;
use Ad5001\BBCodes\BBCode;



class Italic extends BBCode {
    
    
   public function getTagName() : string { return "i"; }
   

   public function __construct(Main $main) {
        $this->main = $main;
        $this->server = $main->getServer();
    }
    
    
    
    public function parse(string $msg) : string {
        return C::BOLD . $msg . C::RESET;
    }
    
    
    
    public function takeParam() : bool { return []; }
    
    
    public function canUse(Player $sender) : bool {
        return $sender->hasPermission("bbcodes.use." . $this->main->getConfig()->get("ItalicPerm"));
    }

}