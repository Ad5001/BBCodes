<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;

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
            $rand = [TextFormat::BLACK, TextFormat::DARK_BLUE, TextFormat::DARK_GREEN, TextFormat::DARK_AQUA, TextFormat::DARK_RED, TextFormat::DARK_PURPLE, TextFormat::GOLD, TextFormat::GRAY, TextFormat::DARK_GRAY, TextFormat::BLUE, TextFormat::GREEN, TextFormat::AQUA, TextFormat::RED, TextFormat::LIGHT_PURPLE, TextFormat::YELLOW, TextFormat::WHITE];
            $arr[$i] = array_rand($rand) . $el;
            $i++;
        }
        return implode("", $arr);
    }
    
    
    
    public function takeParam() : array { return []; }
    
    
    
    public function canUse(CommandSender $sender) : bool {
        return $sender->hasPermission("bbcodes.use." . $this->main->getConfig()->get("FadePerm"));
    }
    
    
    
    public function getDescription() : string {
        return "Make a message ".$this->parse("bounty");
    }
}