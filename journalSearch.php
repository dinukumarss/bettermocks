<html>
   <head>
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
      <link rel="icon" href="branding elements\web_logo(bw).png" sizes="40x40">
      <title>BETTER MOCKS</title>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
      <script>
         $(document).ready(function(){
          
          function load_unseen_notification(view = '')
          {
           $.ajax({
            url:"fetch.php",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data)
            {
             $('.dropdown-menu').html(data.notification);
             if(data.unseen_notification > 0)
             {
              $('.count').html(data.unseen_notification);
             }
            }
           });
          }
          
          load_unseen_notification();
          
          $('#comment_form').on('submit', function(event){
           event.preventDefault();
           if($('#subject').val() != '' && $('#comment').val() != '')
           {
            var form_data = $(this).serialize();
            $.ajax({
             url:"insert.php",
             method:"POST",
             data:form_data,
             success:function(data)
             {
              $('#comment_form')[0].reset();
              load_unseen_notification();
             }
            });
           }
           else
           {
            alert("Both Fields are Required");
           }
          });
          
          $(document).on('click', '.dropdown-toggle', function(){
           $('.count').html('');
           load_unseen_notification('yes');
          });
          
          setInterval(function(){ 
           load_unseen_notification();; 
          }, 5000);
          
         });

      </script>
      <style type="text/css">
      	.wrapper {
    position:relative;
    margin:0 auto;
    overflow:hidden;
	padding:5px;
  	height:50px;
}

.list {
    position:absolute;
    left:0px;
    top:0px;
  	min-width:3000px;
  	margin-left:12px;
    margin-top:0px;
}

.list li{
	display:table-cell;
    position:relative;
    text-align:center;
    cursor:grab;
    cursor:-webkit-grab;
    color:#efefef;
    vertical-align:middle;
}

.scroller {
  text-align:center;
  cursor:pointer;
  display:none;
  padding:7px;
  padding-top:11px;
  white-space:no-wrap;
  vertical-align:middle;
  background-color:#fff;
}

.scroller-right{
  float:right;
}

.scroller-left {
  float:left;
}
      </style>
   </head>
   <body style="padding-top: 70px">
  
   	<div class="col-sm-12 col-xs-12 col-lg-12 col-md-12" style="padding-left: 70px; padding-right: 70px;">
      <div class="navbar navbar-inverse navbar-fixed-top sticky" role="navigation">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" rel="home" title="Better Mocks"><img src="branding elements\tool_logo.png" width="40%" style="padding-left:5px"></a>
         </div>
         <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
               <li><a href="index.html">Paper Search&nbsp;<span class="glyphicon glyphicon-search"></span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right"  style="padding-right:100px">
               <li>
                  <a href="index.html"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-home" style="font-size:18px;"></span></a>
                  <ul class="dropdown-menu"></ul>
               </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-user" style="font-size:18px;"></span></a>
                  <ul class="dropdown-menu"></ul>
               </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
                  <ul class="dropdown-menu"></ul>
               </li>
            </ul>
            <div class="col-sm-3 col-md-3 pull-right">
               <form class="navbar-form" role="search" action="journalSearch.php" method="POST">
                  <div class="input-group">
                     <input type="text" class="form-control" placeholder="Search Journal" size="100" name="category">
                     <div class="input-group-btn">
                        <button class="btn btn-default form-control" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="container">
  <div class="scroller scroller-left"><i class="glyphicon glyphicon-chevron-left"></i></div>
  <div class="scroller scroller-right"><i class="glyphicon glyphicon-chevron-right"></i></div>
  <div class="wrapper">
    <ul class="nav nav-tabs list" id="myTab">
      <li class="active"><a href="journalSearch.php">Journals</a></li>
      <li><a href="conferenceSearch.php">Conferences</a></li>
  </ul>
  </div>
</div>
  <?php
      include "config.php";
      $query = "select * from journals";
      $quer = mysql_query($query);
      if(mysql_num_rows($quer)>0)
      {
        while($result = mysql_fetch_array($quer))
        {

        ?>
<div class = "col-lg-4 col-sm-6 col-md-4 col-xs-6">
         <div class="panel panel-default" style="width: 90%; margin: 10px; padding:10px;">
                      <div class="panel-header" style="padding-left:20px">
<div class="pull-left"><img src="<?php echo $result['Image']; ?>" class="img-circle" width="60px" height="60px"></div>
                     <div class="pull-right"><a href="#content1" data-toggle="collapse"><span  class="glyphicon glyphicon-chevron-down"></span></a></div>
            </div>
            <div class="panel-body">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['Name']; ?><br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['Publisher']; ?><br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result['ISBN']; ?>
            </div>
            <div id="Tabs" role="tabpanel">
               <!-- Nav tabs -->
               <!-- Tab panes -->
               <div class="tab-content" style="padding-top: 10px">
                  <div role="tabpanel" class="tab-pane active" id="personal">

                     <div id="content1" class="collapse" align="justify">
                          Specialisation: <?php echo $result['Specialisation']; ?><br>
                          Impact Factor: <?php echo $result['Impact factor']; ?><br>
                          Acceptance Ratio: <?php echo $result['Acceptance ratio']; ?><br>
                          Citation Score: <?php echo $result['Citation score']; ?><br>
                          Format Type: <?php echo $result['Format type']; ?><br>
                          Mode of Pulishing: <?php echo $result['Mode of publishing']; ?><br>
                          Periodicity: <?php echo $result['Periodicity']; ?><br>
                          Pulishing Fee: <?php echo $result['Publishing fee']; ?><br> 
                          Website: <?php echo $result['Website']; ?><br>
                          Maximum number of paper: <?php echo $result['Max number of paper']; ?><br>
                          Readme <?php echo $result['Readme']; ?><br>
                     </div>
                  </div>
               </div>
            </div>
         </div>
</div>
<?php
}}
?>

  </div>
      <script type="text/javascript">
      	var hidWidth;
var scrollBarWidths = 40;

var widthOfList = function(){
  var itemsWidth = 0;
  $('.list li').each(function(){
    var itemWidth = $(this).outerWidth();
    itemsWidth+=itemWidth;
  });
  return itemsWidth;
};

var widthOfHidden = function(){
  return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
};

var getLeftPosi = function(){
  return $('.list').position().left;
};

var reAdjust = function(){
  if (($('.wrapper').outerWidth()) < widthOfList()) {
    $('.scroller-right').show();
  }
  else {
    $('.scroller-right').hide();
  }
  
  if (getLeftPosi()<0) {
    $('.scroller-left').show();
  }
  else {
    $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
  	$('.scroller-left').hide();
  }
}

reAdjust();

$(window).on('resize',function(e){  
  	reAdjust();
});

$('.scroller-right').click(function() {
  
  $('.scroller-left').fadeIn('slow');
  $('.scroller-right').fadeOut('slow');
  
  $('.list').animate({left:"+="+widthOfHidden()+"px"},'slow',function(){

  });
});

$('.scroller-left').click(function() {
  
	$('.scroller-right').fadeIn('slow');
	$('.scroller-left').fadeOut('slow');
  
  	$('.list').animate({left:"-="+getLeftPosi()+"px"},'slow',function(){
  	
  	});
});
      </script>
   </body>
</html>