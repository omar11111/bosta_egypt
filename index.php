<?php include 'connection.php';
$info=[];

if ($_SERVER["REQUEST_METHOD"]=="POST") {
  $word=$_POST['word'];

  if ( !empty($word)) {
    $query="SELECT govern_info.* ,governorate.name
            FROM govern_info inner join governorate
            on (govern_info.govern_id=governorate.id) 
            where office_name=:word ";
$stmt=$con->prepare($query);
    $stmt->execute(array(':word'=> $word));
    $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
    $row=$stmt->fetchAll();

    if (count($row)==0) {
      echo 'لا يوجد بوسطة بهذا الاسم';
      $info['address']="لا يوجد معلومات";
      $info['postal_number']="لا يوجد معلومات";
      $info['financial_number']="لا يوجد معلومات";
      $info['phone_number']="لا يوجد معلومات";
      $info['name']="لا يوجد معلومات";
    }

  }else {
    echo 'ادخل المكان الذى تريد البحث عنه';
  }
}



?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport"content="width=device-width, initial-scale=1.0"><title>Document</title><style>table {
  border-collapse: collapse;
  width: 100%;
  direction: rtl;
  margin: 20px;

}

th,
td {
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}

th {
  background-color: black;
  color: white;
}

</style></head><body><form action=""method="post"><input class="text"type="text"name="word"value=""><button class="add_button"name="submit"type="submit">Search</button></form><table><tr><th>المحافظة</th><th>البلد</th><th>العنوان</th><th>رقم البوسطة</th><th>الرقم المالى</th><th>التليفون</th></tr><?php if (isset($row)&&count($row)>=1) {
  for ($i=0,$count=count($row); $i < $count; $i++) {
    if ($count==2 && $i==1) {
    break;
    }else {
      echo"<tr>";
      echo "<td>".$row[$i]['name']."</td>";
      echo "<td>".$row[$i]['office_name']."</td>";
      echo "<td> ".$row[$i]['address']."</td>";
      echo "<td>". $row[$i]['postal_number']."</td>";
      echo "<td> ".$row[$i]['financial_number']."</td>";
      echo "<td> ".$row[$i]['phone_number']."</td>";
      echo"</tr>";
    }
    
  }
}

?></table></body></html>