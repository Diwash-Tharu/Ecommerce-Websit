<?php

$to=$to_email ;
$sub=$subject;
$mess=$message;
$from="From The cleck Shop ZOne";

if(mail($to,$sub,$mess,$from))
{
  echo "<script>alert('Email Send');</script>";

}
else
{
  echo "<script>alert('Invalid Email);</script>";
}
?>