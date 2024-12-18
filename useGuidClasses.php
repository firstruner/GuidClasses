<?php

/**
 * This file is a partial class sample
 */

/**
 * Copyright since 2024 Firstruner and Contributors
 * Firstruner is an Registered Trademark & Property of Christophe BOULAS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the proprietary License
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@firstruner.fr so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit, reproduce ou modify this file.
 * Please refer to https://firstruner.fr/ or contact Firstruner for more information.
 *
 * @author    Firstruner and Contributors <contact@firstruner.fr>
 * @copyright Since 2024 Firstruner and Contributors
 * @license   https://wikipedia.org/wiki/Freemium Freemium License
 * @version 2.0.0
 */

header("Content-Type: text/plain");

// Only one require for use Framework Loader
require __DIR__ . '/Core/System/Reflection/Dependencies/Loader.php';

use System\Guid;
use System\Luid;
use System\Reflection\Dependencies\Loader;

// Load dependencies
Loader::Load(
      [
            __DIR__ . '/Interfaces',
            __DIR__ . '/Enumerations',
            __DIR__ . '/Core/System'
      ]
);

// Use elements
echo '--- Use GUID Class ---' . PHP_EOL;

for ($i = 0; $i < 10; $i++)
      echo "Guid Sample : " . Guid::NewGuid() . PHP_EOL;

echo PHP_EOL;
echo '--- Use LUID Class ---' . PHP_EOL;
for ($i = 0; $i < 10; $i++)
      echo "Luid Sample : " . Luid::NewLuid() . PHP_EOL;

echo PHP_EOL;
echo '--- Use LUID Class With Prefix ---' . PHP_EOL;
$prefix = "1stFrmks";

for ($i = 0; $i < 10; $i++)
      echo "Luid Sample : " . Luid::NewLuid($prefix) . PHP_EOL;


echo PHP_EOL;
echo '--- Use LUID Class With Prefix and High Entropy ---' . PHP_EOL;
$prefix = "1stFrmks-High!Entropy";

for ($i = 0; $i < 10; $i++)
      echo "Luid Sample : " . Luid::NewLuid($prefix, true) . PHP_EOL;