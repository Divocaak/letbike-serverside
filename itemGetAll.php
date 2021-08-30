<?php
include "config.php";

$resultArr = [];
$sql = 'SELECT id, seller_id, name, description, price, score, paid, date_start, date_end, imgs, status, sold_to
    FROM item WHERE status=' . $_GET["status"] . ' AND sold_to=' . $_GET["soldTo"] . ' AND seller_id=' . $_GET["id"] . ';';

if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_row($result)) {
        $resultArr[] = [
            "id" => resultCheck($row[0]),
            "sellerId" => resultCheck($row[1]),
            "name" => resultCheck($row[2]),
            "description" => resultCheck($row[3]),
            "price" => resultCheck($row[4]),
            "score" => resultCheck($row[5]),
            "paid" => resultCheck($row[6]),
            "dateStart" => resultCheck($row[7]),
            "dateEnd" => resultCheck($row[8]),
            "imgs" => resultCheck($row[9]),
            "status" => resultCheck($row[10]),
            "soldTo" => resultCheck($row[11])
        ];
    }
    mysqli_free_result($result);
}

for($i = 0; $i < count($resultArr); $i++) {
    $sql = 'SELECT used, selectedCategory, bikeBrand, bikeType, selectedParts, wheelBrand, wheelSize, wheelMaterial, wheeldSpokes, wheeldType, wheelAxis, wheeldBrakesType, wheeldBrakesDisc, wheeldCassette, wheelNut, 
    wheelCompatibility, cranksBrand, cranksCompatibility, cranksMaterial, cranksAxis, converterBrand, converterNumOfSpeeds, saddleBrand, saddleGender, forkBrand, forkSize, forkSuspension, forkSuspensionType, 
    forkWheelCoompatibility, forkMaterial, forkMaterialColumn, selectedAccessories, selectedOther, eBikeBrand, eBikeMotorPos, trainerBrand, trainerBrakes, scooterBrand, scooterSize, scooterComputer, brakeType, 
    brakeBrand, brakeDiscType, brakeDiscSize, brakeBlockType, tireSize, tireWidth, tireBrand, tireType, tireMaterial, tubeSize, tubeType, frameSize, frameFork, frameType, handlebarType, handlebarMaterial, handlebarWidth, 
    handlebarSize, saddleTubeType, saddleTubeLength, saddleTubeMaterial, saddleTubeSize, stemType, axisType, cassetteType, shockAbsType, gearChangeType, pedalsType, rimSize, gripsType, eBikeComponentsType, headsetType, 
    bowdenType, clothesType, clothesClothes, clothesGender, clothesSize, bootsType, bootsSize, helmetType, compType, glassType, glassGlass, glassGender, glassGlassChange, glassHolderChange, kidSaddleType, bottleHolderType, 
    rackType, rackSize, carRackType, toolType, pumpType, lightType, mudguardType, mudguardSize,
    lockType FROM parameters WHERE id=' . $resultArr[$i]["id"] . check("used") . check("selectedCategory") . check("selectedParts") . check("selectedAccessories") . check("selectedOther") . check("bikeType") .
    check("bikeBrand") . check("wheelBrand") . check("wheelSize") . check("wheelMaterial") . check("wheeldSpokes") . check("wheeldType") . check("wheelAxis") . check("wheeldBrakesType") .
    check("wheeldBrakesDisc") . check("wheeldCassette") . check("wheelNut") . check("wheelCompatibility") . check("cranksBrand") . check("cranksCompatibility") . check("cranksMaterial") .
    check("cranksAxis") . check("converterBrand") . check("converterNumOfSpeeds") . check("saddleBrand") . check("saddleGender") . check("forkBrand") . check("forkSize") . check("forkSuspensionType") .
    check("forkSuspension") . check("forkWheelCoompatibility") . check("forkMaterial") . check("forkMaterialColumn") . check("eBikeBrand") . check("eBikeMotorPos") . check("trainerBrand") . check("trainerBrakes") .
    check("scooterBrand") . check("scooterSize") . check("scooterComputer") . ';';

    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_row($result)) {
            $resultArr[$i] = $resultArr[$i] + [
                "used" => resultCheck($row[0]),
                "selectedCategory" => resultCheck($row[1]),
                "bikeBrand" => resultCheck($row[2]),
                "bikeType" => resultCheck($row[3]),
                "selectedParts" => resultCheck($row[4]),
                "wheelBrand" => resultCheck($row[5]),
                "wheelSize" => resultCheck($row[6]),
                "wheelMaterial" => resultCheck($row[7]),
                "wheeldSpokes" => resultCheck($row[8]),
                "wheeldType" => resultCheck($row[9]),
                "wheelAxis" => resultCheck($row[10]),
                "wheeldBrakesType" => resultCheck($row[11]),
                "wheeldBrakesDisc" => resultCheck($row[12]),
                "wheeldCassette" => resultCheck($row[13]),
                "wheelNut" => resultCheck($row[14]),
                "wheelCompatibility" => resultCheck($row[15]),
                "cranksBrand" => resultCheck($row[16]),
                "cranksCompatibility" => resultCheck($row[17]),
                "cranksMaterial" => resultCheck($row[18]),
                "cranksAxis" => resultCheck($row[19]),
                "converterBrand" => resultCheck($row[20]),
                "converterNumOfSpeeds" => resultCheck($row[21]),
                "saddleBrand" => resultCheck($row[22]),
                "saddleGender" => resultCheck($row[23]),
                "forkBrand" => resultCheck($row[24]),
                "forkSize" => resultCheck($row[25]),
                "forkSuspension" => resultCheck($row[26]),
                "forkSuspensionType" => resultCheck($row[27]),
                "forkWheelCoompatibility" => resultCheck($row[28]),
                "forkMaterial" => resultCheck($row[29]),
                "forkMaterialColumn" => resultCheck($row[30]),
                "selectedAccessories" => resultCheck($row[31]),
                "selectedOther" => resultCheck($row[32]),
                "eBikeBrand" => resultCheck($row[33]),
                "eBikeMotorPos" => resultCheck($row[34]),
                "trainerBrand" => resultCheck($row[35]),
                "trainerBrakes" => resultCheck($row[36]),
                "scooterBrand" => resultCheck($row[37]),
                "scooterSize" => resultCheck($row[38]),
                "scooterComputer" => resultCheck($row[39]),
                "brakeType" => resultCheck($row[40]),
                "brakeBrand" => resultCheck($row[41]),
                "brakeDiscType" => resultCheck($row[42]),
                "brakeDiscSize" => resultCheck($row[43]),
                "brakeBlockType" => resultCheck($row[44]),
                "tireSize" => resultCheck($row[45]),
                "tireWidth" => resultCheck($row[46]),
                "tireBrand" => resultCheck($row[47]),
                "tireType" => resultCheck($row[48]),
                "tireMaterial" => resultCheck($row[49]),
                "tubeSize" => resultCheck($row[50]),
                "tubeType" => resultCheck($row[51]),
                "frameSize" => resultCheck($row[52]),
                "frameFork" => resultCheck($row[53]),
                "frameType" => resultCheck($row[54]),
                "handlebarType" => resultCheck($row[55]),
                "handlebarMaterial" => resultCheck($row[56]),
                "handlebarWidth" => resultCheck($row[57]),
                "handlebarSize" => resultCheck($row[58]),
                "saddleTubeType" => resultCheck($row[59]),
                "saddleTubeLength" => resultCheck($row[60]),
                "saddleTubeMaterial" => resultCheck($row[61]),
                "saddleTubeSize" => resultCheck($row[62]),
                "stemType" => resultCheck($row[63]),
                "axisType" => resultCheck($row[64]),
                "cassetteType" => resultCheck($row[65]),
                "shockAbsType" => resultCheck($row[66]),
                "gearChangeType" => resultCheck($row[67]),
                "pedalsType" => resultCheck($row[68]),
                "rimSize" => resultCheck($row[69]),
                "gripsType" => resultCheck($row[70]),
                "eBikeComponentsType" => resultCheck($row[71]),
                "headsetType" => resultCheck($row[72]),
                "bowdenType" => resultCheck($row[73]),
                "clothesType" => resultCheck($row[74]),
                "clothesClothes" => resultCheck($row[75]),
                "clothesGender" => resultCheck($row[76]),
                "clothesSize" => resultCheck($row[77]),
                "bootsType" => resultCheck($row[78]),
                "bootsSize" => resultCheck($row[79]),
                "helmetType" => resultCheck($row[80]),
                "compType" => resultCheck($row[81]),
                "glassType" => resultCheck($row[82]),
                "glassGlass" => resultCheck($row[83]),
                "glassGender" => resultCheck($row[84]),
                "glassGlassChange" => resultCheck($row[85]),
                "glassHolderChange" => resultCheck($row[86]),
                "kidSaddleType" => resultCheck($row[87]),
                "bottleHolderType" => resultCheck($row[88]),
                "rackType" => resultCheck($row[89]),
                "rackSize" => resultCheck($row[90]),
                "carRackType" => resultCheck($row[91]),
                "toolType" => resultCheck($row[92]),
                "pumpType" => resultCheck($row[93]),
                "lightType" => resultCheck($row[94]),
                "mudguardType" => resultCheck($row[95]),
                "mudguardSize" => resultCheck($row[96]),
                "lockType" => resultCheck($row[97])
            ];
        }
        mysqli_free_result($result);
    }
}
mysqli_close($link);


function check($identificator){
    if(isset($_GET[$identificator])){
        $val = $_GET[$identificator];
        if ($val > 999) {
            $val -= (999 +
              (isset($_GET["selecetedOther"])
                  ? $_GET["selecetedOther"]
                  : 0) +
              (isset($_GET["selectedParts"])
                  ? $_GET["selectedParts"]
                  : 0));
        }
        else if($val == -1){
            return "";
        }
        else{
            return " AND " . $identificator . "=" . $val;
        }
    }
    else{
        return "";
    }
}

function resultCheck($res){
    return (($res == "") ? "-1" : $res);
}

echo json_encode($resultArr);
?>