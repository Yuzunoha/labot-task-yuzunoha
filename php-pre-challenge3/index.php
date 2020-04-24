<?php

function calcPaper(array $a, int $idxStart, int $offsetColumn, int $offsetRow)
{
  if ($idxStart < 0 || $offsetColumn < 0 || $offsetRow < 0) {
    return -1;
  }
  /* 引数のスカラー値はすべて0以上である */

  $len = count($a);
  if ($len <= $idxStart + $offsetColumn + $offsetRow) {
    return -2;
  }
  /* 配列の範囲外エラーにならない */

  $debugIdxListOfSumUp = [];

  $sum = 0;
  for ($i = $idxStart; $i < $offsetColumn; $i++) {
    $sum += $a[$i];
    $debugIdxListOfSumUp[] = $i;
  }
  $sum += $a[$offsetColumn + $offsetRow];
  $debugIdxListOfSumUp[] = $offsetColumn + $offsetRow;
  return [$sum, $debugIdxListOfSumUp];
}


function practice3(array $a, int $target)
{
  // 型チェック
  foreach ($a as $v) {
    if (false === is_int($v)) {
      throw new Exception('配列に整数以外の要素が混じっています');
    }
  }

  // 解く
  $ansIdxes = [];
  $len = count($a);
  for ($idxStart = 0; $idxStart < $len; $idxStart++) {
    for ($offsetColumn = 0; $offsetColumn < $len; $offsetColumn++) {
      if ($len <= $idxStart + $offsetColumn) {
        // インデックスが範囲外
        break;
      }
      for ($offsetRow = 0; $offsetRow < $len; $offsetRow++) {
        $result = calcPaper($a, $idxStart, $offsetColumn, $offsetRow);
        $sum = $result[0];
        if ($sum < 0) {
          // インデックスが範囲外
          break;
        }
        if ($target < $sum) {
          // 合計値が超えた
          break;
        }
        if ($target === $sum) {
          // 正解
          $ansIdxes[] = $result[1];
        }
      }
    }
  }

  $ans = [];
  foreach ($ansIdxes as $ansIdx) {
    $tmp = [];
    foreach ($ansIdx as $idx) {
      $tmp[] = $a[$idx];
    }
    $ans[] = $tmp;
  }

  return $ans;
}

function main()
{
  $a = [1, 2, 3, 4, 5, 6, 7];
  $target = 7;

  $ans = practice3($a, $target);
  print_r($ans);
}

main();
