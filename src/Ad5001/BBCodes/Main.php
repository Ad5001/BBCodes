<?php
namespace Ad5001\BBCodes;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerChatEvent;


use Ad5001\BBCodes\Bold as CodeBold;
use Ad5001\BBCodes\Italic as CodeItalic;
use Ad5001\BBCodes\Color as CodeColor;
use Ad5001\BBCodes\URL as CodeURL;
// use Ad5001\BBCodes\Quote as QuoteCode;
use Ad5001\BBCodes\NewLine as NewLineCode;
use Ad5001\BBCodes\Line as LineCode;
use Ad5001\BBCodes\Fade as FadeCode;
use Ad5001\BBCodes\ListCode;
use Ad5001\BBCodes\BBCodesManager;


class Main extends PluginBase implements Listener{


   public function onEnable(){
        $this->reloadConfig();
        $this->bbcodesManager = new BBCodesManager($this);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $bbcm = $this->bbcodesManager;
        $bbcm->registerTag($this, new CodeBold($this));
        $bbcm->registerTag($this, new CodeItalic($this));
        $bbcm->registerTag($this, new CodeColor($this));
        $bbcm->registerTag($this, new CodeURL($this));
        // $bbcm->registerTag($this, new QuoteCode($this));
        $bbcm->registerTag($this, new NewLineCode($this));
        $bbcm->registerTag($this, new LineCode($this));
        $bbcm->registerTag($this, new FadeCode($this));
        $bbcm->registerTag($this, new ListCode($this));
    }


    public function onLoad(){
        $this->saveDefaultConfig();
    }
    
    
    public function onPlayerChat(PlayerChatEvent $event) {
        // $this->getServer()->broadcastMessage($event->getMessage());
        $event->setMessage($this->bbcodesManager->parse($event->getPlayer(), $event->getMessage()));
        // $this->getServer()->broadcastMessage($event->getMessage());
    }
    
    
    public function getBBCodesManager() {
        return $this->bbcodesManager;
    }
    
    
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        switch($cmd->getName()){
            case "bbcodes":
            if(isset($args[0])) {
                
                switch(true) {
                    
                    case strtolower($args[0]) == "help":
                    $sender->sendMessage("§a§o§l[§r§6BBCodes§a§o§l] §r§f Here are all the BBcodes that you have the access to :");
                    $access = [];
                    foreach($this->bbcodesManager->getTags() as $key => $tag) {
                        if($tag->canUse($sender)) {
                            $class = new \ReflectionClass(get_class($tag));
                            array_push($access, "[*] " . $class->getShortName() . " : [$key]Message[$key] . " . $tag->getDescription());
                        }
                    }
                    $sender->sendMessage($this->bbcodesManager->getTagByTag("list")->parse(implode("", $access), 1));
                    return true;
                    break;
                    
                    
                    case $this->bbcodesManager->getTagByName($args[0]) !== false:
                    $class = new \ReflectionClass(get_class($this->bbcodesManager->getTagByName($args[0])));
                    $sender->sendMessage("§a§o§l[§r§6BBCodes§a§o§l] §r§f Help for " .  $class->getShortName() . " :");
                    $sender->sendMessage("Usage : [{$this->bbcodesManager->getTagByName($args[0])->getTagName()}]Message[{$this->bbcodesManager->getTagByName($args[0])->getTagName()}] | Description : " . $this->bbcodesManager->getTagByName($args[0])->getDescription() . " | Can you use it ? " . $this->bbcodesManager->getTagByTag($args[0])->canUse($sender));
                    return true;
                    break;
                    
                    
                    case $this->bbcodesManager->getTagByTag($args[0]) !== false:
                    $class = new \ReflectionClass(get_class($this->bbcodesManager->getTagByTag($args[0])));
                    $sender->sendMessage("§a§o§l[§r§6BBCodes§a§o§l] §r§f Help for " . $class->getShortName() . " :");
                    $sender->sendMessage("Usage : [$args[0]]Message[$args[0]] | Description : " . $this->bbcodesManager->getTagByTag($args[0])->getDescription() . " | Can you use it ? " . $this->bbcodesManager->getTagByTag($args[0])->canUse($sender));
                    return true;
                    break;
                    
                    default:
                    return false;
                    break;
                }
            }
            break;
        }
     return false;
    }
}