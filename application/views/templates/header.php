<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $title?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url();?>assets/images/mpp_icon.png">
    <link rel="stylesheet" href="<?= base_url();?>assets/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="<?= base_url();?>assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url();?>assets/vendor/select2/css/select2.min.css">
    <!-- Datatable -->
    <link href="<?= base_url();?>assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- jQuery dan Popper.js -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/basic.min.css" />
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.27.3/dist/apexcharts.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->


    <style>
    .widget-line-list li {
        font-size: 20px;
    }
    .dropzone {
        background: white;
        border-radius: 10px;
        border: 3px dashed rgb(0, 135, 247);
        border-image: none;
        margin-left: auto;
        margin-right: auto;
    }
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
.wrapper{
  background: #f6f6f6;
  max-width: 360px;
  width: 100%;
  border-radius: 10px;
  box-shadow: 0px 10px 15px rgba(0,0,0,0.1);
}
.wrapper .content{
  padding: 30px;
  display: flex;
  align-items: center;
  flex-direction: column;
}
.wrapper .outer{
  height: 135px;
  width: 135px;
  overflow: hidden;
}
.outer .emojis{
  height: 500%;
  display: flex;
  flex-direction: column;
}
.outer .emojis li{
  height: 20%;
  width: 100%;
  list-style: none;
  transition: all 0.3s ease;
}
.outer li img{
  height: 100%;
  width: 100%;
}
#star-2:checked ~ .content .emojis .slideImg{
  margin-top: -135px;
}
#star-3:checked ~ .content .emojis .slideImg{
  margin-top: -270px;
}
#star-4:checked ~ .content .emojis .slideImg{
  margin-top: -405px;
}
#star-5:checked ~ .content .emojis .slideImg{
  margin-top: -540px;
}
.wrapper .stars{
  margin-top: 30px;
}
.stars label{
  font-size: 30px;
  margin: 0 3px;
  color: #ccc;
}
#star-1:hover ~ .content .stars .star-1,
#star-1:checked ~ .content .stars .star-1,

#star-2:hover ~ .content .stars .star-1,
#star-2:hover ~ .content .stars .star-2,
#star-2:checked ~ .content .stars .star-1,
#star-2:checked ~ .content .stars .star-2,

#star-3:hover ~ .content .stars .star-1,
#star-3:hover ~ .content .stars .star-2,
#star-3:hover ~ .content .stars .star-3,
#star-3:checked ~ .content .stars .star-1,
#star-3:checked ~ .content .stars .star-2,
#star-3:checked ~ .content .stars .star-3,

#star-4:hover ~ .content .stars .star-1,
#star-4:hover ~ .content .stars .star-2,
#star-4:hover ~ .content .stars .star-3,
#star-4:hover ~ .content .stars .star-4,
#star-4:checked ~ .content .stars .star-1,
#star-4:checked ~ .content .stars .star-2,
#star-4:checked ~ .content .stars .star-3,
#star-4:checked ~ .content .stars .star-4,

#star-5:hover ~ .content .stars .star-1,
#star-5:hover ~ .content .stars .star-2,
#star-5:hover ~ .content .stars .star-3,
#star-5:hover ~ .content .stars .star-4,
#star-5:hover ~ .content .stars .star-5,
#star-5:checked ~ .content .stars .star-1,
#star-5:checked ~ .content .stars .star-2,
#star-5:checked ~ .content .stars .star-3,
#star-5:checked ~ .content .stars .star-4,
#star-5:checked ~ .content .stars .star-5{
  color: #fd4;
}
.wrapper .footer{
  border-top: 1px solid #ccc;
  background: #f2f2f2;
  width: 100%;
  height: 55px;
  padding: 0 20px;
  border-radius: 0 0 10px 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.footer span{
  font-size: 17px;
  font-weight: 400;
}
.footer .text::before{
  content: "Tingkat Kepuasan!";
}
.footer .numb::before{
  content: "Skor 1-5";
}
#star-1:checked ~ .footer .text::before{
  content: "Sangat Tidak Suka";
}
#star-1:checked ~ .footer .numb::before{
  content: "1 dari 5";
}
#star-2:checked ~ .footer .text::before{
  content: "Tidak Suka";
}
#star-2:checked ~ .footer .numb::before{
  content: "2 dari 5";
}
#star-3:checked ~ .footer .text::before{
  content: "Cukup Baik";
}
#star-3:checked ~ .footer .numb::before{
  content: "3 dari 5";
}
#star-4:checked ~ .footer .text::before{
  content: "Baik";
}
#star-4:checked ~ .footer .numb::before{
  content: "4 dari 5";
}
#star-5:checked ~ .footer .text::before{
  content: "Sangat Baik";
}
#star-5:checked ~ .footer .numb::before{
  content: "5 dari 5";
}
input[type="radio"]{
  display: none;
}

    </style>
        <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

.wrapper {
  background: #f6f6f6;
  max-width: 360px;
  width: 100%;
  border-radius: 10px;
  box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
}

.wrapper .content {
  padding: 30px;
  display: flex;
  align-items: center;
  flex-direction: column;
}

.wrapper .outer {
  height: 135px;
  width: 135px;
  overflow: hidden;
}

.outer .emojis2 {
  height: 500%;
  display: flex;
  flex-direction: column;
}

.outer .emojis2 li {
  height: 20%;
  width: 100%;
  list-style: none;
  transition: all 0.3s ease;
}

.outer li img {
  height: 100%;
  width: 100%;
}

#star-2:checked ~ .content .emojis2 .slideImg {
  margin-top: -135px;
}

#star-3:checked ~ .content .emojis2 .slideImg {
  margin-top: -270px;
}

#star-4:checked ~ .content .emojis2 .slideImg {
  margin-top: -405px;
}

#star-5:checked ~ .content .emojis2 .slideImg {
  margin-top: -540px;
}

.wrapper .stars {
  margin-top: 30px;
}

.stars label {
  font-size: 30px;
  margin: 0 3px;
  color: #ccc;
}

#star-1:hover ~ .content .stars .star-1,
#star-1:checked ~ .content .stars .star-1,
#star-2:hover ~ .content .stars .star-1,
#star-2:hover ~ .content .stars .star-2,
#star-2:checked ~ .content .stars .star-1,
#star-2:checked ~ .content .stars .star-2,
#star-3:hover ~ .content .stars .star-1,
#star-3:hover ~ .content .stars .star-2,
#star-3:hover ~ .content .stars .star-3,
#star-3:checked ~ .content .stars .star-1,
#star-3:checked ~ .content .stars .star-2,
#star-3:checked ~ .content .stars .star-3,
#star-4:hover ~ .content .stars .star-1,
#star-4:hover ~ .content .stars .star-2,
#star-4:hover ~ .content .stars .star-3,
#star-4:hover ~ .content .stars .star-4,
#star-4:checked ~ .content .stars .star-1,
#star-4:checked ~ .content .stars .star-2,
#star-4:checked ~ .content .stars .star-3,
#star-4:checked ~ .content .stars .star-4,
#star-5:hover ~ .content .stars .star-1,
#star-5:hover ~ .content .stars .star-2,
#star-5:hover ~ .content .stars .star-3,
#star-5:hover ~ .content .stars .star-4,
#star-5:hover ~ .content .stars .star-5,
#star-5:checked ~ .content .stars .star-1,
#star-5:checked ~ .content .stars .star-2,
#star-5:checked ~ .content .stars .star-3,
#star-5:checked ~ .content .stars .star-4,
#star-5:checked ~ .content .stars .star-5 {
  color: #fd4;
}

.wrapper .footer {
  border-top: 1px solid #ccc;
  background: #f2f2f2;
  width: 100%;
  height: 55px;
  padding: 0 20px;
  border-radius: 0 0 10px 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.footer span {
  font-size: 17px;
  font-weight: 400;
}

.footer .text::before {
  content: "Tingkat Kepuasan!";
}

.footer .numb::before {
  content: "Skor 1-5";
}

#star-1:checked ~ .footer .text::before {
  content: "Sangat Tidak Suka";
}

#star-1:checked ~ .footer .numb::before {
  content: "1 dari 5";
}

#star-2:checked ~ .footer .text::before {
  content: "Tidak Suka";
}

#star-2:checked ~ .footer .numb::before {
  content: "2 dari 5";
}

#star-3:checked ~ .footer .text::before {
  content: "Cukup Baik";
}

#star-3:checked ~ .footer .numb::before {
  content: "3 dari 5";
}

#star-4:checked ~ .footer .text::before {
  content: "Baik";
}

#star-4:checked ~ .footer .numb::before {
  content: "4 dari 5";
}

#star-5:checked ~ .footer .text::before {
  content: "Sangat Baik";
}

#star-5:checked ~ .footer .numb::before {
  content: "5 dari 5";
}

input[type="radio"] {
  display: none;
}

    </style>
</head>
<body>
