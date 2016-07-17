<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\command\CommandSender;

use Ad5001\BBCodes\Main;
use Ad5001\BBCodes\BBCode;



class URL extends BBCode {
    
    
   public function getTagName() : string { return "url"; }
   

   public function __construct(Main $main) {
        $this->main = $main;
        $this->server = $main->getServer();
    }
    
    
    
    public function parse(string $msg) : string {
        if (filter_var($msg, FILTER_VALIDATE_URL)) {
            return C::DARK_BLUE . C::UNDERLINE . $msg . C::WHITE . C::RESET;
        } else {
            return $msg;
        }
    }
    
    
    
    public function takeParam() : array { return []; }
    
    
    public function canUse(CommandSender $sender) : bool {
        return $sender->hasPermission("bbcodes.use." . $this->main->getConfig()->get("URLPerm"));
    }
    
    
    public function getDescription() : string {
        return "Make an URL underlined and blue : " . C::DARK_BLUE . C::UNDERLINE . "http://ad5001.ga" . C::WHITE . C::RESET . ".";
    }

}