<!DOCTYPE html>
<html>
<head>
    <title>Tous les templates</title>
</head>
<body>

<h1>Tous les templates</h1>

<?php
echo "<body style='background-color: #080f25; color: white; padding: 20px; display: grid; grid-template-columns: repeat(3, 1fr); grid-gap: 20px;'>";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    echo "<a href='temp1_pdf.php?id=$id'><img src='imgTemplate/template1.png' alt='Image' width='150' height='200'></a>";
    echo "<a href='temp2_pdf.php?id=$id'><img src='imgTemplate/template2.png' alt='Image' width='150' height='200'></a>";
    echo "<a href='temp3_pdf.php?id=$id'><img src='imgTemplate/template3.png' alt='Image' width='150' height='200'></a>";
    echo "<a href='temp4_pdf.php?id=$id'><img src='imgTemplate/template4.png' alt='Image' width='150' height='200'></a>";
    echo "<a href='temp5_pdf.php?id=$id'><img src='imgTemplate/template5.png' alt='Image' width='150' height='200'></a>";
    echo "<a href='temp6_pdf.php?id=$id'><img src='imgTemplate/template6.png' alt='Image' width='150' height='200'></a>";
    echo "<a href='temp7_pdf.php?id=$id'><img src='imgTemplate/template7.png' alt='Image' width='150' height='200'></a>";
    echo "<a href='temp8_pdf.php?id=$id'><img src='imgTemplate/template8.png' alt='Image' width='150' height='200'></a>";
    echo "<a href='temp9_pdf.php?id=$id'><img src='imgTemplate/template9.png' alt='Image' width='150' height='200'></a>";
    echo "<a href='temp10_pdf.php?id=$id'><img src='imgTemplate/template10.png' alt='Image' width='150' height='200'></a>";

} else {
    echo "Aucun ID n'a été spécifié.";
}

echo "</body>";
?>

</body>
</html>
