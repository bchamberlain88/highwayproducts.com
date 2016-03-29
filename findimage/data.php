<?php error_reporting(E_ALL^E_NOTICE); session_start(); ?>

<head>
    <style>

    body {
        background:#eee;
        font-family:Arial,Helvetica,sans-serif;
        margin:0px;
        padding:0px;
    }

    img {
        border:0px;
    }

    .search-form {
        background:#fff; 
        border-bottom:20px solid #eee;
        height:80px; 
        position:fixed; 
        top:0px; 
        width:100%;
        z-index:100;
    }

    .logo-mask {
        background:#fff;
        bottom:0px;
        display:none;
        height:100%;
        position:absolute;
        right:0px;
        top:0px;
        width:calc(100% - 70px);
    }

    .logo {
        background:url(http://www.lanster.org/projects/hpi.v2/assets/images/highway-logo.png)center center no-repeat;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        float:left;
        height:40px;
        margin:20px 0px 20px 20px;
        position:relative;
        width:214px;
    }

    .search-input {
        background:#f5f5f5; 
        border:1px solid rgba(0,0,0,0.25);
        border-radius:3px;
        box-shadow:inset 0px 0px 0px 1px rgba(255,255,255,0.5);
        color:#555;
        float:left; 
        height:40px; 
        margin:20px; 
        outline:none;
        padding:0px 20px;
        position: relative;
        transition:0.3s;
        width:calc(25% - 28px);
        z-index: 10;
    }

    .search-input:focus {
        border:1px solid #888;
    }

    .search-button {
        background:#4285f4;
        border:1px solid rgba(0,0,0,0.25);
        border-radius:3px;
        box-shadow:inset 0px 0px 0px 1px rgba(255,255,255,0.15);
        color:#fff; 
        float:left; 
        font-size:11px;
        font-weight:bold;
        height:40px; 
        letter-spacing:1px;
        line-height:40px; 
        margin:20px 0px;
        outline:none;
        padding:0px 20px;
        text-transform:uppercase; 
        transition:0.3s;
    }

    .search-button:hover {
        background:#333;
        cursor:pointer;
    }

    .loading {
        background:url(../loading.gif) center center no-repeat;
        float:right;
        height:40px;
        margin:20px 5px 20px 20px;
        width:40px;
    }

    .loaded {
        color:#666;
        float:right;
        font-size:11px;
        height:40px;
        line-height:40px;
        margin:20px 20px 20px 0px;
    }

    .content {
        float:left; 
        height:auto;
        margin:100px 0px 0px 20px; 
        width:calc(100% - 20px);
    }

    .result-full {
        height:calc(100% - 120px);
    }

    .result {
        float:left;
        height:140px;
        margin:0 20px 20px 0;
        overflow:hidden;
        position:relative; 
        width:calc(12.5% - 20px);
    }

    .result img {
        bottom: 0px;
        display: none;
        height:auto;
        left:50%;
        margin:0px;
        padding:0px;
        position: absolute;
        -webkit-transform:translateX(-50%);
        -ms-transform:translateX(-50%);
        transform:translateX(-50%);
        width:100%;
    }

    .view {
        background: url(http://www.highwayproducts.com/images/view.png) center center no-repeat rgba(0,0,0,0.75);
        bottom:0px;
        left:0px;
        opacity:0;
        position:absolute;
        right:0px;
        top:0px;
        transition:0.3s;
        width:100%;
        z-index:5;
    }

    .result:hover .view {
        opacity:1;
    }

    .popup {

        background:rgba(0,0,0,0.75);
        display:none;
        height:100%;
        left:0px;
        position:fixed;
        top:0px;
        transition:0.3s;
        width: 100%;
        z-index:200;

    }

    .popup-img {
        box-shadow:0px 0px 0px 1px rgba(255,255,255,0.75),
        0px 0px 0px 2px rgba(0,0,0,0.75),
        0px 0px 100px 25px rgba(0,0,0,0.5);
        display:none;
        height:auto;
        left:50%;
        max-height:calc(100% - 40px);
        max-width:calc(100% - 40px);
        position:fixed;
        transition:0.3s;
        -webkit-transform:translateY(-50%);
        -ms-transform:translateY(-50%);
        transform:translateY(-50%);
        top:50%;
        width:auto;
    }

    .popup-info {
        background:transparent;
        border:1px solid transparent;
        color:#fff;
        font-size:16px;
        font-weight:bold;
        height:40px;
        left:50%;
        letter-spacing:1px;
        line-height:40px;
        position:fixed;
        text-align:left;
        text-shadow: 1px 1px 1px rgba(0,0,0,0.75);
        top:50%;
    }

    @media(max-width:1100px){

        .result {
            width:calc(20% - 20px);
        }

        .search-input {
            width:calc(60% - 242px);
        }

        .popup-img {
            max-height:calc(100% - 160px);
            max-width:calc(100% - 160px);
        }

    }

    @media(max-width:800px){

        .logo-mask {
            display: block;
        }

        .search-input {
            margin:20px 20px 20px -130px; 
            width:calc(50% - 28px);
        }

        .result {
            width:calc(25% - 20px);
        }

        .popup-img {
            max-height:calc(100% - 100px);
            max-width:calc(100% - 100px);
        }

    }

    @media(max-width:600px){

        .load-wrapper {
            background:#fff;
            bottom:0px;
            height:40px;
            left:0px;
            position:fixed;
            width:100%;
            z-index:10;
        }

        .loading {
            left:20px;
            margin:0px;
            position:absolute;
        }

        .loaded {
            float:left;
            margin:0px 0px 0px 60px;
        }

        .search-input {
            width:calc(100% - 124px);
        }

        .result {
            height:200px;
            width:calc(50% - 20px);
        }

        .popup-img {
            max-height:calc(100% - 40px);
            max-width:calc(100% - 40px);
        }

        .popup-info {
            top:calc(50% + 30px);
        }

    }

    @media(max-width:480px){

        .result {
            width:calc(100% - 20px);
        }

        .popup-info {
            top:calc(50% + 50px);
        }

    }

    </style>
</head>
<body>
<?php include("./connect.php"); include("./functions.php"); ?>

<form action="./" class="search-form" method="post">
    <div class="logo"><div class="logo-mask"></div></div>
    <div class="load-wrapper">
        <label class="loaded"><span class="current">0</span> of <span class="total">0</span></label>
        <div class="loading"></div>
    </div>
</form>

<div class="content">

<?php $directory = "../images/gallery/products/";
list_files($directory); ?>

</div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">

    $(".search-input").focus();

    var a = $("img").length,
        b = 0;

    $(".total").empty().append(a);

    $("img").each(function(i){
       $(this).load(function(){
        $(this).fadeIn(300); i++;
        $(".current").empty().append(i);

        if(i === a){
            $("img").fadeIn(300);
            $(".loaded").empty().append("FINISHED");
            $(".loading, .loaded").delay(1000).fadeOut();
        }

       }); 

    });

    $(".search-input").keyup(function(){
        if($(this).val() === ""){
            $(".result").fadeIn(300); $(".loaded").fadeOut(300);
        }else{
            $(".search-form").submit(); 
        }
    });

    $(".search-form").submit(function(event){

        event.preventDefault();
        var query = $(".search-input").val().replace("HP","").replace(" ","").replace("hp","");
        if(query === ""){ $(".result").fadeIn(300); $(".loaded").fadeOut(300); }else{
        $(".result").hide();
        $("div[id^='"+query+"']").fadeIn(300); }

        var results = $("div[id^='"+query+"']").length;
        $(".loaded").show().empty().append(results+" Search Results");

    });

    $(".result-link").click(function(event){

        event.preventDefault();
        var c = $(this).attr("href"),
            x = $(this).attr("data-desc"),
            z = $(this).attr("alt");
        
        if($(".popup").length >= 1){}else{

            $("body").append("<div class='popup'/>");
            $(".popup").append("<img class='popup-img' src='"+c+"'/>");

            $(".popup").delay(300).fadeIn(300, function(){

                var d = $(".popup-img").width(),
                    e = d/2,
                    f = $(".popup-img").height(),
                    g = f/2;

                $(".popup-img").css("margin", "0px 0px 0px -"+e+"px");
                $(".popup").append("<div class='popup-info'>"+x+"</div>");
                $(".popup-info").css("width",d).css("margin", (e-80)+"px 0px 0px -"+e+"px");
                $(".popup-img").delay(300).fadeIn(300);

                $(window).keyup(function(event){
                    event.preventDefault();
                    var key = event.keyCode || event.which; 
                    if(key === 27){ $(".popup").click(); }
                });

                $(".popup").click(function(){
                    $(".popup-img").delay(150).fadeOut(150, function(){
                        $(".popup").delay(150).fadeOut(150, function(){
                            $(this).remove();
                        }); 
                    });
                });
            });

        }

    });

</script>
</body>