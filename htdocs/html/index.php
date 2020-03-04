<?php
// alla använder samma page controller (starta session en egen header som används till meny och sen en require till den riktiga koden)
session_start();

$h1 = "Frågor";

 require "../php/Templates/Template_index.php";
?>