<?php
declare(strict_types=1);
namespace Crasher508\MyPlotMerge;

use pocketmine\block\Block;
use pocketmine\event\level\LevelLoadEvent;
use pocketmine\lang\BaseLang;
use pocketmine\level\biome\Biome;
use pocketmine\level\format\Chunk;
use pocketmine\level\generator\GeneratorManager;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use MyPlot\Commands;
use MyPlot\MyPlot;
use MyPlot\Plot;
use MyPlot\subcommand\SubCommand;
use pocketmine\scheduler\Task;

class Main extends PluginBase
{
}
