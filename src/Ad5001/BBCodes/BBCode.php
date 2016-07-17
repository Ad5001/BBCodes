<?php
namespace Ad5001\BBCodes;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\CommandSender;

use Ad5001\BBCodes\Main;



abstract class BBCode {
    
    
   abstract function getTagName() : string;
    
    
   abstract function __construct(Main $main);
   
   
   abstract function parse(string $msg) : string;
   
   
   abstract function takeParam() : array;
   
   
   abstract function canUse(CommandSender $sender) : bool;
   
   
   abstract function getDescription() : string;

}