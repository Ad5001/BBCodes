<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

use Ad5001\BBCodes\Main;
use Ad5001\BBCodes\BBCode;



class NewLine extends BBCode {
    
    
   public function getTagName() : string { return "br"; }
   

   public function __construct(Main $main) {
        $this->main = $main;
        $this->server = $main->getServer();
    }
    
    
    
    public function parse(string $msg) : string {
        return PHP_EOL . $msg;
    }
    
    
    
    public function takeParam() : bool { return []; }
    
    
    
    public function canUse(Player $sender) : bool {
        return $sender->hasPermission("bbcodes.use." . $this->main->getConfig()->get("NewLinePerm"));
    }
}