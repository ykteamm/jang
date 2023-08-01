<!-- Favicons -->
{{-- <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
<link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
<link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png"> --}}

<!-- Material icons-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Google fonts-->
{{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet"> --}}

<!-- swiper CSS -->
<link href="{{asset('mobile/vendor/swiper/css/swiper.min.css')}}" rel="stylesheet">
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<!-- Custom styles for this template -->
<link href="{{asset('mobile/css/style.css')}}" rel="stylesheet" id="style">
<link href="{{asset('mobile/css/btn.css')}}" rel="stylesheet" id="style">
<link href="{{asset('mobile/css/team.css')}}" rel="stylesheet" id="style">
<link href="{{asset('mobile/css/media/users.css')}}" rel="stylesheet" id="style">
<link href="{{asset('mobile/css/media/battle_date.css')}}" rel="stylesheet" id="style">
<link href="{{asset('mobile/css/media/for-img.css')}}" rel="stylesheet" id="style">
<link href="{{asset('mobile/css/media/bugun.css')}}" rel="stylesheet" id="style">

<link href="{{asset('mobile/vendor/swiper/css/swiper.min.css')}}" rel="stylesheet" id="style">

{{-- <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet"> --}}
<style>
  .plans {
      background-color: aliceblue;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
  }

  .difference {
      width: 100%;
      height: 100%;
      position: absolute !important;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      display: flex !important;
      justify-content: center;
      align-items: center;
  }

  .difference span {
      font-family: monospace;
      font-weight: 700;
      font-size: 25;
  }

  .planChart {
      position: relative;
      width: 100%;
      height: 100%;
  }

  .planChart div {
      width: 100%;
      height: 100%;
  }

  #difSum {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
  }

  .apexcharts-legend {
      display: none !important;
  }
</style>
<style>
    img.instruksiya {
      animation: ins 2s linear infinite;
    }
    @keyframes ins {
      0% {
        transform: scale(1);
      }
      50%{
        transform: scale(1.2);
      }
      100%{
        transform: scale(1);
      }
    }
    @-webkit-keyframes ins {
      0% {
        transform: scale(1);
      }
      50%{
        transform: scale(1.1);
      }
      100%{
        transform: scale(1);
      }
    }
    @font-face {
    font-family: Supercell-Magic;
    src: url('/promo/dist/fonts/SVN-Supercell Magic.otf');
    }
    @font-face {
      font-family: Gilroy ExtraBold;
      src: url('/promo/dist/fonts/FontsFree-Net-Gilroy-ExtraBold.ttf');
    }
    .supercell{
      font-family: Supercell-Magic;
    }
    .gilroy{
      font-family: Gilroy ExtraBold;
    }
   
    .profile-img {
    width: 230px;
    height: 230px;
    border: 6px solid #d845fe;
    background: url(img/duck.png) no-repeat;
    -moz-box-shadow: 0px 6px 5px #ccc;
    -webkit-box-shadow: 0px 6px 5px #ccc;
    box-shadow:
    0px 0px 15px #cc00ff;
    -moz-border-radius: 190px;
    -webkit-border-radius: 190px;
    border-radius: 190px;
}
     input:not[type="submit"] {
        background-color: #ffffff;
        border: 1px solid #cccccc;
        padding: 5px;
      }
      input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0 1000px white inset !important;
      }
      .hidden-input {
        display: none;
      }
      .custom-file-upload{
        color: #14528a;
        background: #f7f7f7;
        padding: 8px;
        border: 1px solid #e3e3e3;
        border-radius: 5px;
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
      }
      .product-border{
        border: 1px solid royalblue;
        border-radius: 15px;
        padding: 13px;
      }
      .plus-border{
        border: 2px solid green;
        border-radius: 15px;
        padding: 13px;
      }
      .img-container {
        position: relative;
      }

      .text-block {
        position: absolute;
        bottom: 11%;
        right: 0%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }


      .stars1 {
        position: absolute;
        bottom: 55%;
        right: 67%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }

      .stars2 {
        position: absolute;
        bottom: 55%;
        right: 56%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      .stars3 {
        position: absolute;
        bottom: 55%;
        right: 45%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      .stars4 {
        position: absolute;
        bottom: 55%;
        right: 34%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      .stars5 {
        position: absolute;
        bottom: 55%;
        right: 23%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      @media screen and (max-width: 360px) {
        .stars1 {
        position: absolute;
        bottom: 55%;
        right: 68%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        }
        .stars2 {
          position: absolute;
          bottom: 55%;
          right: 56%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
          }
        .stars3 {
          position: absolute;
          bottom: 55%;
          right: 44%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
          }
        .stars4 {
          position: absolute;
          bottom: 55%;
          right: 32%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .stars5 {
          position: absolute;
          bottom: 55%;
          right: 20%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (min-width: 400px) {
        .stars1 {
        position: absolute;
        bottom: 55%;
        right: 65%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        }
        .stars2 {
          position: absolute;
          bottom: 55%;
          right: 55%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
          }
        .stars3 {
          position: absolute;
          bottom: 55%;
          right: 45%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
          }
        .stars4 {
          position: absolute;
          bottom: 55%;
          right: 35%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .stars5 {
          position: absolute;
          bottom: 55%;
          right: 25%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (min-width: 450px) {
        .stars1 {
        position: absolute;
        bottom: 55%;
        right: 59%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        }
        .stars2 {
          position: absolute;
          bottom: 55%;
          right: 50%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
          }
        .stars3 {
          position: absolute;
          bottom: 55%;
          right: 41%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
          }
        .stars4 {
          position: absolute;
          bottom: 55%;
          right: 32%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .stars5 {
          position: absolute;
          bottom: 55%;
          right: 23%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (min-width: 510px) {
        .stars1 {
        position: absolute;
        bottom: 55%;
        right: 59%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        }
        .stars2 {
          position: absolute;
          bottom: 55%;
          right: 51%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
          }
        .stars3 {
          position: absolute;
          bottom: 55%;
          right: 43%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
          }
        .stars4 {
          position: absolute;
          bottom: 55%;
          right: 34%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .stars5 {
          position: absolute;
          bottom: 55%;
          right: 25%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      .natija-img {
        position: absolute;
        bottom: 11%;
        right: 0%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      @media screen and (min-width: 360px) {
        .natija-img {
        position: absolute;
        bottom: 11%;
        right: 0%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      }
      @media screen and (min-width: 397px) {
        .natija-img {
        position: absolute;
        bottom: 11%;
        right: 0%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      }
      @media screen and (min-width: 400px) {
        .natija-img {
        position: absolute;
        bottom: 11%;
        right: 0%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      }
      @media screen and (max-width: 420px) {
        .bugun1 {
          position: absolute;
          bottom: 37%;
          right: 48%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun1 img{
          width: 150px;
        }
        .bugun2 img{
          width: 150px;
        }
        .bugun2 {
          position: absolute;
          bottom: 37%;
          right: 2%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 400px) {
        .bugun1 {
          position: absolute;
          bottom: 37%;
          right: 48%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun1 img{
          width: 140px;
        }
        .bugun2 img{
          width: 140px;
        }
        .bugun2 {
          position: absolute;
          bottom: 37%;
          right: 2%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 380px) {
        .bugun1 {
          position: absolute;
          bottom: 37%;
          right: 48%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun1 img{
          width: 140px;
        }
        .bugun2 img{
          width: 140px;
        }
        .bugun2 {
          position: absolute;
          bottom: 37%;
          right: 2%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 360px) {
        .bugun1 {
          position: absolute;
          bottom: 35%;
          right: 46%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun1 img{
          width: 135px;
        }
        .bugun2 img{
          width: 135px;
        }
        .bugun2 {
          position: absolute;
          bottom: 35%;
          right: 0%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 340px) {
        .bugun1 {
          position: absolute;
          bottom: 35%;
          right: 46%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun1 img{
          width: 130px;
        }
        .bugun2 img{
          width: 130px;
        }
        .bugun2 {
          position: absolute;
          bottom: 35%;
          right: 0%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 320px) {
        .bugun1 {
          position: absolute;
          bottom: 35%;
          right: 46%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun1 img{
          width: 120px;
        }
        .bugun2 img{
          width: 120px;
        }
        .bugun2 {
          position: absolute;
          bottom: 35%;
          right: 0%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 300px) {
        .bugun1 {
          position: absolute;
          bottom: 38%;
          right: 46%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun1 img{
          width: 110px;
        }
        .bugun2 img{
          width: 110px;
        }
        .bugun2 {
          position: absolute;
          bottom: 38%;
          right: 1%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }

      .bugun_date1 {
        position: absolute !important;
        bottom: 45%;
        right: 61%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      .bugun_date2 {
        position: absolute !important;
        bottom: 45%;
        right: 10%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      @media screen and (max-width: 420px) {
        .bugun_date1 {
        position: absolute !important;
        bottom: 45%;
        right: 58%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 18px;
        -webkit-text-stroke: 1px #040c10 !important;

        }
        .bugun_date2 {
        position: absolute;
        bottom: 45%;
        right: 12%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 18px;
        -webkit-text-stroke: 1px #040c10 !important;
        }
      }
      @media screen and (max-width: 400px) {
        .bugun_date1 {
        position: absolute;
        bottom: 45%;
        right: 58%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 18px;
        -webkit-text-stroke: 1px #040c10 !important;

        }
        .bugun_date2 {
        position: absolute;
        bottom: 45%;
        right: 12%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 18px;
        -webkit-text-stroke: 1px #040c10 !important;
        }
      }
      @media screen and (max-width: 380px) {
        .bugun_date1 {
        position: absolute;
        bottom: 46%;
        right: 59%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 17px;
        -webkit-text-stroke: 1px #040c10 !important;

        }
        .bugun_date2 {
        position: absolute;
        bottom: 46%;
        right: 12%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 17px;
        -webkit-text-stroke: 1px #040c10 !important;
        }
      }
      @media screen and (max-width: 360px) {
        .bugun_date1 {
        position: absolute;
        bottom: 44%;
        right: 54%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 16px;
        -webkit-text-stroke: 1px #040c10 !important;

        }
        .bugun_date2 {
        position: absolute;
        bottom: 44%;
        right: 10%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 16px;
        -webkit-text-stroke: 1px #040c10 !important;
        }
      }
      @media screen and (max-width: 340px) {
        .bugun_date1 {
        position: absolute;
        bottom: 44%;
        right: 54%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 16px;
        -webkit-text-stroke: 1px #040c10 !important;

        }
        .bugun_date2 {
        position: absolute;
        bottom: 44%;
        right: 10%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 16px;
        -webkit-text-stroke: 1px #040c10 !important;
        }
      }
      @media screen and (max-width: 320px) {
        .bugun_date1 {
        position: absolute;
        bottom: 44%;
        right: 54%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 16px;
        -webkit-text-stroke: 1px #040c10 !important;

        }
        .bugun_date2 {
        position: absolute;
        bottom: 44%;
        right: 10%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 16px;
        -webkit-text-stroke: 1px #040c10 !important;
        }
      }
      @media screen and (max-width: 300px) {
        .bugun_date1 {
        position: absolute;
        bottom: 47%;
        right: 54%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 16px;
        -webkit-text-stroke: 1px #040c10 !important;

        }
        .bugun_date2 {
        position: absolute;
        bottom: 47%;
        right: 10%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 16px;
        -webkit-text-stroke: 1px #040c10 !important;
        }
      }


      .bugun_price1 {
        position: absolute;
        bottom: 39%;
        right: 61%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      .bugun_price2 {
        position: absolute;
        bottom: 39%;
        right: 6%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      @media screen and (max-width: 400px) {
        .bugun_price1 {
          position: absolute;
          bottom: 39%;
          right: 52%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun_price2 {
          position: absolute;
          bottom: 39%;
          right: 6%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 380px) {
        .bugun_price1 {
          position: absolute;
          bottom: 39%;
          right: 52%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun_price2 {
          position: absolute;
          bottom: 39%;
          right: 6%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 360px) {
        .bugun_price1 {
          position: absolute;
          bottom: 37%;
          right: 52%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun_price2 {
          position: absolute;
          bottom: 37%;
          right: 6%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 340px) {
        .bugun_price1 {
          position: absolute;
          bottom: 37%;
          right: 52%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun_price2 {
          position: absolute;
          bottom: 37%;
          right: 6%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 320px) {
        .bugun_price1 {
          position: absolute;
          bottom: 37%;
          right: 52%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun_price2 {
          position: absolute;
          bottom: 37%;
          right: 6%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      @media screen and (max-width: 300px) {
        .bugun_price1 {
          position: absolute;
          bottom: 40%;
          right: 52%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
        .bugun_price2 {
          position: absolute;
          bottom: 40%;
          right: 6%;
          color: white;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
      .responsive-img {
          width: 104%;
          height: auto;
      }
      .text-font{
        font-size: 14px;
      }
      .batte-text {
        position: absolute;
        bottom: 28%;
        right: 16%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      .counter-text {
        position: absolute;
        bottom: 35%;
        right: -6%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }
      .reyting-user {
        position: absolute;
        bottom: 1%;
        right: 0%;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
      }

</style>
