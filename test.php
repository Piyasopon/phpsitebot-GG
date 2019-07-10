<?php
  $data = 'xxx'; // ตัวแปร PHP

  echo '<script type="text/javascript">';
  echo "var data = '$data';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
  echo '</script>';
?>

<script type="text/javascript">
  alert(data); // ทดสอบแสดงตัวแปร
</script>