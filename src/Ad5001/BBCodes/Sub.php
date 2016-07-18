<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\command\CommandSender;

use Ad5001\BBCodes\Main;
use Ad5001\BBCodes\BBCode;



class Sub extends BBCode {
    
    
   public function getTagName() : string { return "sub"; }
   

   public function __construct(Main $main) {
        $this->main = $main;
        $this->server = $main->getServer();
    }
    
    
    
    public function parse(string $msg) : string {
        $chars = ["₀", "₁", "₂", "₃", "₄", "₅", "₆", "₇", "₈", "₉", "₊", "₋", "₌", "₍", "₎", "ₐ", "ₑ", "ₕ", "ₖ", "ₗ", "ₘ", "ₙ", "ₒ", "ₚ", "ₛ", "ₜ", "ₓ"];
        $letters = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "+", "-", "=", "(", ")", "a", "e", "h", "k", "l", "m", "n", "o", "p", "s", "t", "x"];
        $num = 0;
        while(isset($letters[$num])) {
            $msg = str_ireplace($letters[$num], $chars[$num], $msg);
            $num++;
        }
        return $msg;
    }
    
    
    
    public function takeParam() : array { return []; }
    
    
    
    public function canUse(CommandSender $sender) : bool {
        return $sender->hasPermission("bbcodes.use." . $this->main->getConfig()->get("BoldPerm"));
    }
    
    
    
    public function getDescription() : string {
        return "Transform a message to " . $this->parse("subscript") . ".";
    }
}