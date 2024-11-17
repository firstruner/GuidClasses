<?php

class LuidGenerator {
      private static int $lastTimestamp = 0;  // Dernier horodatage utilisé
      private static int $counter = 0;       // Compteur atomique
      private static int $maxCounter = 4095; // Limite pour le compteur (12 bits)
      private static string $processId = ''; // ID du processus, généré une fois
  
      // Initialisation du processus ID (appelée une seule fois automatiquement)
      public static function initialize(): void {
          if (empty(self::$processId)) {
              // Utilise getmypid() ou une alternative aléatoire si non disponible
              self::$processId = function_exists('getmypid') 
                  ? str_pad(dechex(getmypid()), 4, '0', STR_PAD_LEFT) 
                  : bin2hex(random_bytes(2));
          }
      }
  
      // Générer un LUID
      public static function generate(): string {
          $timestamp = (int)(microtime(true) * 1000); // Horodatage en millisecondes
          $counter = 0;
  
          // Gérer le compteur atomique et l'horodatage
          if ($timestamp === self::$lastTimestamp) {
              self::$counter = (self::$counter + 1) & self::$maxCounter; // Réinitialiser si limite atteinte
              $counter = self::$counter;
  
              if ($counter === 0) {
                  // Attendre la prochaine milliseconde si le compteur est saturé
                  while ($timestamp <= self::$lastTimestamp) {
                      $timestamp = (int)(microtime(true) * 1000);
                  }
              }
          } else {
              self::$counter = 0; // Réinitialiser le compteur pour un nouvel horodatage
              $counter = self::$counter;
          }
  
          self::$lastTimestamp = $timestamp;
  
          // Partie aléatoire
          $randomPart = bin2hex(random_bytes(4));
  
          // Construction du LUID
          return sprintf(
              '%08X-%s-%03X-%s',
              $timestamp,      // Timestamp en millisecondes
              self::$processId, // ID du processus
              $counter,        // Compteur atomique
              $randomPart      // Partie aléatoire
          );
      }
  }
  
  // Initialisation (appelée une seule fois au début)
  LuidGenerator::initialize();
  
  // Générer des LUIDs (méthode statique)
  echo LuidGenerator::generate() . PHP_EOL;
  echo LuidGenerator::generate() . PHP_EOL;
  echo LuidGenerator::generate() . PHP_EOL;