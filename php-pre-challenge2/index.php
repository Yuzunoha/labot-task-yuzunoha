<?php
$array = array(3, 2, 1, 4, 15, 18, 13, 99, 77, 66, 1, 100, 0);
bubbleSort($array);
print_r($array);

function swap(array &$a, int $idxLeft, int $idxRight): void
{
  $tmp = $a[$idxLeft];
  $a[$idxLeft] = $a[$idxRight];
  $a[$idxRight] = $tmp;
}

function bubbleSort(array &$a): void
{
  $len = count($a);
  for ($i = 0; $i < $len; $i++) {
    for ($j = 0; $j < $len - $i - 1; $j++) {
      $idxLeft = $j;
      $idxRight = $j + 1;
      if ($a[$idxRight] < $a[$idxLeft]) {
        swap($a, $idxLeft, $idxRight);
      }
    }
  }
}
