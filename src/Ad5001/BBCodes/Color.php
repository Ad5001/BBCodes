<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\command\CommandSender;

use Ad5001\BBCodes\Main;
use Ad5001\BBCodes\BBCode;



class Color extends BBCode {
    
    
   public function getTagName() : string { return "color"; }
   

   public function __construct(Main $main) {
        $this->main = $main;
        $this->server = $main->getServer();
    }
    
    
    
    public function parse(string $msg, string $param = null) : string {
        switch(strtolower($param)) {
            case "red":
            return C::RED . $msg . C::WHITE;
            break;
            case "aqua":
            return C::AQUA . $msg . C::WHITE;
            break;
            case "dark_aqua":
            return C::DARK_AQUA . $msg . C::WHITE;
            break;
            case "dark_blue":
            return C::BLUE . $msg . C::WHITE;
            break;
            case "lime":
            return C::GREEN . $msg . C::WHITE;
            break;
            case "green":
            return C::DARK_GREEN . $msg . C::WHITE;
            break;
            case "orange":
            return C::GOLD . $msg . C::WHITE;
            break;
            case "yellow":
            return C::YELLOW . $msg . C::WHITE;
            break;
            case "dark_red":
            return C::DARK_RED . $msg . C::WHITE;
            break;
            case "dark_purple":
            return C::DARK_PURPLE . $msg . C::WHITE;
            break;
            case "gray":
            return C::GRAY . $msg . C::WHITE;
            break;
            case "dark_gray":
            return C::DARK_GRAY . $msg . C::WHITE;
            break;
            case "blue":
            return C::BLUE . $msg . C::WHITE;
            break;
            case "dark_blue":
            return C::DARK_BLUE . $msg . C::WHITE;
            break;
            case "black":
            return C::BLACK . $msg . C::WHITE;
            break;
            case "white":
            case null:
            return C::WHITE . $msg;
            break;
        }
    }
    
    
    
    public function takeParam() : array { return ["red", "blue", "dark_blue", "lime", "green", "orange", "yellow", "dark_red", "dark_purple", "dark_aqua", "aqua", "gray", "dark_gray", "black"]; }
    
    
    
    public function canUse(CommandSender $sender) : bool {
        return $sender->hasPermission("bbcodes.use." . $this->main->getConfig()->get("ColorPerm"));
    }
    
    public function getDescription() : string {
        return "Change the §acolor§f of the message.";
    }

}