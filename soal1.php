<?php

$jml = $_GET['jml'];
echo "<table border=1>\n";
for ($a = $jml; $a > 0; $a--)
{
  $total=0;
  for ($b = $a; $b > 0;$b--)
  {
      $total += $b;
  }
  echo "<tr>\n <td colspan='$a'>$total</td>\n</tr>\n";
  
  echo "<tr>\n";
  for ($b = $a; $b > 0; $b--)
  {
    echo "<td>$b</td>";
  }
  echo "</tr>\n";
}
echo "</table>";

?>