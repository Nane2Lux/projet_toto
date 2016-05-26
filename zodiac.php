<?php

//inclut automatiquement tous les packages de Composer
require_once __DIR__.'/vendor/autoload.php';

use Whatsma\ZodiacSign;

$calculator = new ZodiacSign\Calculator();

$zodiacSign = $calculator->calculate(22,5);

  switch ($zodiacSign) {
  	case 'aries':
  		$ZodiacSign = 'Belier';
  		break;
  	case 'taurus':
  		$ZodiacSign = 'Taureau';
  		break;
  	case 'gemini':
  		$ZodiacSign = 'Gémeaux';
  		break;
  	case 'cancer':
  		$ZodiacSign = 'Cancer';
  		break;	
  	case 'leo':
  		$ZodiacSign = 'Lion';
  		break;
  	case 'virgo':
  		$ZodiacSign = 'Vierge';
  		break;
  	case 'libra':
  		$ZodiacSign = 'Balance';
  		break;
  	case 'scorpio':
  		$ZodiacSign = 'Scorpion';
  		break;
  	case 'sagitarius':
  		$ZodiacSign = 'Sagitaire';
  		break;
  	case 'capricorn':
  		$ZodiacSign = 'Capricorne';
  		break;
  	case 'aquarius':
  		$ZodiacSign = 'Verseau';
  		break;;
  	case 'pisces':
  		$ZodiacSign = 'Poisson';
  		break;
  	default:
  		$ZodiacSign = '????';
  		break;
  }

try {
  
  echo $ZodiacSign . "\n";
} catch (ZodiacSign\InvalidDayException $e) {
  echo "ERROR: Invalid Day";
} catch (ZodiacSign\InvalidMonthException $e) {
  echo "ERROR: Invalid Month";
}

