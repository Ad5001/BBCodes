<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;

use Ad5001\BBCodes\Main;
use Ad5001\BBCodes\BBCode;



class ListCode extends BBCode {
    
    
   public function getTagName() : string { return "list"; }
   

   public function __construct(Main $main) {
        $this->main = $main;
        $this->server = $main->getServer();
    }
    
    
    
    public function parse(string $msg, string $param = null) : string {
        $sentences = explode("[*]", $msg);
        $chars = [];
        $charnum = count($sentences);
        switch($param) {
            
            case "a":
            $num = round($sentences / 26) + 1;
            for($i = 0; $i < $num; $i++) {
                array_merge($chars, ["a.", "b.", "c.", "d.", "e.", "f.", "g.", "i.", "j.", "k.", "l.", "m.", "n.", "o.", "p.", "q.", "r.", "s.", "t.", "u.", "v.", "w.", "x.", "z."]);
            }
            break;
            
            case "1":
            $i = 1;
            foreach($sentences as $sentence) {
                array_push($chars, $i . ".");
                $i++;
            }
            break;
            
            default:
            foreach($sentences as $sentence) {
                array_push($chars, "-");
            }
            break;
        }
        $i = 0;
        foreach($sentences as $sentence) {
            $sentences[$i] = $chars[$i] . " " . $sentence;
            $i++;
        }
        return implode(PHP_EOL, $sentences);
    }
    
    
    
    public function takeParam() : array { return ["", "1", "a"]; }
    
    
    
    public function canUse(CommandSender $sender) : bool {
        return $sender->hasPermission("bbcodes.use." . $this->main->getConfig()->get("ListPerm"));
    }
    
    
    
    public function getDescription() : string {
        return "Make easily lists by using this tag. To make a list, just do [list=<a (will be listed by a., b., c., ect...) | 1 (will be listed by 1., 2., 3., ect.) | (will be listed with -)]First element[§f*]Second Element[§f*]Third element[§f*]...[/list]";
    }
}