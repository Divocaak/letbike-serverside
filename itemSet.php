<?php
header("Content-Type: text/html; charset=utf-8");

include "config.php";

$sql = 'INSERT INTO item ( seller_id, name, description, price, imgs, status, sold_to)
VALUES (' . $_GET["seller_id"] . ', "' . $_GET["name"] . '", "' . $_GET["description"] . '", "' . $_GET["price"] . '", ' . $_GET["images"] . ', 0, -1)';

$canInsertParams = false;
if (mysqli_query($link, $sql)) {
  $canInsertParams = true;
}

if($canInsertParams){
  $sql = 'INSERT INTO parameters (used, selectedCategory, bikeBrand, bikeType, selectedParts,
    wheelBrand, wheelSize, wheelMaterial, wheeldSpokes, wheeldType, wheelAxis, wheeldBrakesType, wheeldBrakesDisc, wheeldCassette, wheelNut, wheelCompatibility, cranksBrand, cranksCompatibility, cranksMaterial, cranksAxis,
    converterBrand, converterNumOfSpeeds, saddleBrand, saddleGender, forkBrand, forkSize, forkSuspension, forkSuspensionType, forkWheelCoompatibility, forkMaterial, forkMaterialColumn, selectedAccessories, selectedOther,
    eBikeBrand, eBikeMotorPos, trainerBrand, trainerBrakes, scooterBrand, scooterSize, scooterComputer, brakeType, brakeBrand, brakeDiscType, brakeDiscSize, brakeBlockType, tireSize, tireWidth, tireBrand, tireType, tireMaterial,
    tubeSize, tubeType, frameSize, frameFork, frameType, handlebarType, handlebarMaterial, handlebarWidth, handlebarSize, saddleTubeType, saddleTubeLength, saddleTubeMaterial, saddleTubeSize, stemType, axisType, cassetteType,
    shockAbsType, gearChangeType, pedalsType, rimSize, gripsType, eBikeComponentsType, headsetType, bowdenType, clothesType, clothesClothes, clothesGender, clothesSize, bootsType, bootsSize, helmetType, compType,
    glassType, glassGlass, glassGender, glassGlassChange, glassHolderChange, kidSaddleType, bottleHolderType, rackType, rackSize, carRackType, toolType, pumpType, lightType, mudguardType, mudguardSize, lockType
    ) VALUES (' . check("used") . ', ' . check("selectedCategory") . ', ' . check("bikeBrand") . ', ' . check("bikeType") . ', ' . check("selectedParts") . ', ' . check("wheelBrand") . ', ' . check("wheelSize") . ', 
    ' . check("wheelMaterial") . ', ' . check("wheeldSpokes") . ', ' . check("wheeldType") . ', ' . check("wheelAxis") . ', ' . check("wheeldBrakesType") . ', ' . check("wheeldBrakesDisc") . ', ' . check("wheeldCassette") . ', 
    ' . check("wheelNut") . ', ' . check("wheelCompatibility") . ', ' . check("cranksBrand") . ', ' . check("cranksCompatibility") . ', ' . check("cranksMaterial") . ', ' . check("cranksAxis") . ', ' . check("converterBrand") . ', 
    ' . check("converterNumOfSpeeds") . ', ' . check("saddleBrand") . ', ' . check("saddleGender") . ', ' . check("forkBrand") . ', ' . check("forkSize") . ', ' . check("forkSuspension") . ', ' . check("forkSuspensionType") . ', 
    ' . check("forkWheelCoompatibility") . ', ' . check("forkMaterial") . ', ' . check("forkMaterialColumn") . ', ' . check("selectedAccessories") . ', ' . check("selectedOther") . ', ' . check("eBikeBrand") . ', 
    ' . check("eBikeMotorPos") . ', ' . check("trainerBrand") . ', ' . check("trainerBrakes") . ', ' . check("scooterBrand") . ', ' . check("scooterSize") . ', ' . check("scooterComputer") . ', ' . check("brakeType") . ', 
    ' . check("brakeBrand") . ', ' . check("brakeDiscType") . ', ' . check("brakeDiscSize") . ', ' . check("brakeBlockType") . ', ' . check("tireSize") . ', ' . check("tireWidth") . ', ' . check("tireBrand") . ', 
    ' . check("tireType") . ', ' . check("tireMaterial") . ', ' . check("tubeSize") . ', ' . check("tubeType") . ', ' . check("frameSize") . ', ' . check("frameFork") . ', ' . check("frameType") . ', 
    ' . check("handlebarType") . ', ' . check("handlebarMaterial") . ', ' . check("handlebarWidth") . ', ' . check("handlebarSize") . ', ' . check("saddleTubeType") . ', ' . check("saddleTubeLength") . ', 
    ' . check("saddleTubeMaterial") . ', ' . check("saddleTubeSize") . ', ' . check("stemType") . ', ' . check("axisType") . ', ' . check("cassetteType") . ', ' . check("shockAbsType") . ', 
    ' . check("gearChangeType") . ', ' . check("pedalsType") . ', ' . check("rimSize") . ', ' . check("gripsType") . ', ' . check("eBikeComponentsType") . ', ' . check("headsetType") . ', 
    ' . check("bowdenType") . ', ' . check("clothesType") . ', ' . check("clothesClothes") . ', ' . check("clothesGender") . ', ' . check("clothesSize") . ', ' . check("bootsType") . ', 
    ' . check("bootsSize") . ', ' . check("helmetType") . ', ' . check("compType") . ', ' . check("glassType") . ', ' . check("glassGlass") . ', ' . check("glassGender") . ', 
    ' . check("glassGlassChange") . ', ' . check("glassHolderChange") . ', ' . check("kidSaddleType") . ', ' . check("bottleHolderType") . ', ' . check("rackType") . ', 
    ' . check("rackSize") . ', ' . check("carRackType") . ', ' . check("toolType") . ', ' . check("pumpType") . ', ' . check("lightType") . ', ' . check("mudguardType") . ', 
    ' . check("mudguardSize") . ', ' . check("lockType") . ');';

  if (mysqli_query($link, $sql)) {
    echo "Inzerát byl úspěšně uložen.";
  } else {
    echo "Někde se stala chyba, zkuste to prosím později.";
  }
  mysqli_close($link);
}
else{
  echo "Někde se stala chyba, zkuste to prosím později.";
}

function check($val){
  return isset($_GET[$val]) ? $_GET[$val] : -1;
}
?>