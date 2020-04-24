<?php

function calcSum(array $a, int $idxStart, int $offsetColumn, int $offsetRow)
{
  if ($idxStart < 0 || $offsetColumn < 0 || $offsetRow < 0) {
    return -1;
  }
  $len = count($a);
  $idxMax = $idxStart + $offsetColumn + $offsetRow;
  if ($len <= $idxMax) {
    return -2;
  }

  $sum = 0;
  $idxes = [];
  for ($i = $idxStart; $i < $idxStart + $offsetColumn; $i++) {
    $sum += $a[$i];
    $idxes[] = $i;
  }
  $sum += $a[$idxMax];
  $idxes[] = $idxMax;

  return [
    'sum' => $sum,
    'idxes' => $idxes,
  ];
}

function run(array $a, int $target)
{
  /* ガード処理やります */

  $len = count($a);
  $ansIdxesList = [];
  for ($idxStart = 0; $idxStart < $len; $idxStart++) {
    for ($offsetColumn = 0; $offsetColumn < $len; $offsetColumn++) {
      if ($len <= $idxStart + $offsetColumn) {
        break;
      }
      for ($offsetRow = 0; $offsetRow < $len; $offsetRow++) {
        $result = calcSum($a, $idxStart, $offsetColumn, $offsetRow);
        $sum = $result['sum'];
        if ($sum < 0 || $target < $sum) {
          break;
        }
        if ($sum === $target) {
          $ansIdxesList[] = $result['idxes'];
        }
      }
    }
  }

  $ansNumsList = [];
  foreach ($ansIdxesList as $ansIdxes) {
    $ansNums = [];
    foreach ($ansIdxes as $ansIdx) {
      $ansNums[] = $a[$ansIdx];
    }
    $ansNumsList[] = $ansNums;
  }
  return $ansNumsList;
}

function main()
{
  /* DBとrequestを模したのドライバ */
  $a = [1, 2, 3, 4, 5];
  $target = 7;

  /* 実行 */
  $result = run($a, $target);
  print_r($result);
}

main();
