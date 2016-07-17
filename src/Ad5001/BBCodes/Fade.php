<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

use Ad5001\BBCodes\Main;
use Ad5001\BBCodes\BBCode;



class Fade extends BBCode {
    
    
   public function getTagName() : string { return "fade"; }
   

   public function __construct(Main $main) {
        $this->main = $main;
        $this->server = $main->getServer();
    }
    
    
    
    public function parse(string $msg) : string {
        $arr = str_split($msg);
        $i = 0;
        foreach($arr as $el) {
            $rand = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f"];
            $arr[$i] = "§" . array_rand($rand) . $el;
            $i++;
        }
        return implode("", $el);
    }
    
    
    
    public function takeParam() : bool { return []; }
    
    
    
    public function canUse(Player $sender) : bool {
        return $sender->hasPermission("bbcodes.use." . $this->main->getConfig()->get("FadePerm"));
    }
}