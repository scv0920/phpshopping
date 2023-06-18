<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "common.php";
	$cookie_no=$_COOKIE["cookie_no"];
	$cookie_name=$_COOKIE["cookie_name"];
?>


<html>
<head>

<title>Uniform bridge</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="include/font.css" rel="stylesheet" type="text/css">
<script language="Javascript" src="include/common.js"></script>
</head>
  <style>
  body {
    font-family: 'Helvetica';
}
<body style="margin:0">
<div id="header" class="">
    <style>
	
	/* base */
*{ padding: 0; margin: 0; } /* 여백제거 */
li{ list-style: none; } /* 기호제거 */

.gallery{
  width: 20%px; 
  
  margin: 0 auto; /* 블록요소 가운데처리 */
  overflow: hidden; /* float받은 자손이나 후손의 높이도 인식 */
}
.gallery h3{
  width: 100%; height: 50px;
  text-align: center;
  /* 높이와 줄간격을 같게 하면 한줄 텍스트 가운데 처리 */ 
  line-height: 50px;
}
.gallery li{
  float: left;
  width: 300px; height: 200px;
  margin-right: 20px;
}
.gallery li:last-child{ margin-right: 0; }

.gallery a{
  display: block;
  width: 100%; height: 100%;
  overflow: hidden; /* 자손이 현재 요소보다 클때 안보이게 처리 */
}

/* CSS변화가 있을때 시간차를 줌 */
.gallery img{ transition: 0.3s; }
.gallery a:hover img, .gallery a:focus img{ /* a태그에 마우스를 올렸을 때 */
  transform: scale(1.2);
}
 * {
	 box-sizing: border-box;
}
 a {
	 text-decoration: none;
	 color: inherit;
}
 .description {
	 margin: 1em auto 2.25em;
}
 ul {
	 list-style: none;
	 padding: 0;
}
 ul .inner2 {
	 padding-left: 1em;
	 overflow: hidden;
	 display: none;
}
 .drawer__content ul li {
     text-align:left;
     line-height:30px;
}
 ul li a.toggle {
	 width: fit-content;
	 display: block;
	 color: #000;
	 padding: 0;
	 transition: background .3s ease;
}
 ul li a.toggle:hover {
}
</style> 
    
<style>
    .drawer {
      display: none;
    }
    .drawer__overlay {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      width: 100%;
      z-index: 200;
      opacity: 0;
      
      transition: opacity 0.3s;
      will-change: opacity;

      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;      
    }

    .drawer__header {
      /* Optional */
      padding: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 0px solid #ddd;
    }

    .drawer__close {
      /* Optional */
      position:absolute;
      top: 30px;
      right: 34px;
      margin: 0;
      padding: 0;
      border: none;
      background-color: transparent;
      cursor: pointer;
      background-image: url("data:image/svg+xml,%0A%3Csvg width='15px' height='16px' viewBox='0 0 15 16' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'%3E%3Cg id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'%3E%3Cg id='2.-Menu' transform='translate(-15.000000, -13.000000)' stroke='%23000000'%3E%3Cg id='Group' transform='translate(15.000000, 13.521000)'%3E%3Cpath d='M0,0.479000129 L15,14.2971819' id='Path-3'%3E%3C/path%3E%3Cpath d='M0,14.7761821 L15,-1.24344979e-14' id='Path-3'%3E%3C/path%3E%3C/g%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      width: 15px;
      height: 15px;
      flex-shrink: 0;
      margin-left: 1.5rem;
      z-index:9999;
    }

    .drawer__wrapper {
      position: fixed;
      top: 0px;
      right: 0;
      bottom: 0;
      height: 100%;
      width: 100%;
       max-width: 400px;      
      z-index: 9999999;
      overflow: auto;
      transition: transform 0.3s;
      will-change: transform;
      background-color: #fff;
      display: flex;
      flex-direction: column; 
      -webkit-transform: translate3d(100%, 0, 0);
      transform: translate3d(100%, 0, 0); /* extra 3% because of box-shadow */ 
      
      -webkit-overflow-scrolling: touch; /* enables momentum scrolling in iOS overflow elements */

      /* Optional */
    }

    .drawer__content {
      position: relative;
      overflow-x: hidden;
      overflow-y: auto;
      height: 100%;
      flex-grow: 1;
      /* Optional */
      padding: 0;
    }
	.drawer__content ul li a {
      	margin-left:30px;
    }    
/*    .drawer--left .drawer__wrapper {
      left: 0;
      top: 28px;
      right: auto;
      -webkit-transform: translate3d(-100%, 0, 0);
      transform: translate3d(-100%, 0, 0);
    }*/

    .drawer.is-active {
      display: contents;
    }

    .drawer.is-visible .drawer__wrapper {
      -webkit-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
    }

    .drawer.is-visible .drawer__overlay {
      opacity: 0.5;
    }
      
     .drilldown {
      text-align:left;
      overflow: hidden;
      width: 100%;
      padding: 0px;

      -webkit-transform: translate3d(0,0,0);
              transform: translate3d(0,0,0);
    }
    .drilldown-sub {
      display: none;
    }
    .drilldown-back {
      font-weight: bold;
    }    
    
.drawer__content ul li a {
  display: inline-block;
  position: relative;
  color: #000;
  text-decoration: none;
}
.drawer__content ul li a::after {
  content: '';
  position: absolute;
  width: 100%;
  transform: scaleX(0);
  border-radius: 5px;
  height: 0.1em;
  bottom: 5px;
  left: 0;
  background: currentcolor;
  transform-origin: bottom right;
  transition: transform 0.25s ease-out;
}
.drawer__content ul li a:hover::after {
  transform: scaleX(1);
  transform-origin: bottom left;
}            
.mobile-menu-button {position: fixed; top: 16px;  right:24px ;z-index:9999;}

    
@media only screen and (min-width: 1024px) {
/*.mobile-menu-button {display:none!important;}    */
.left-gnb {position:fixed; display:block;width:80vw;top:0px;z-index:9999999;}     
.mobile-logo {display:none!important;}   
}    
ul.gnb {
    margin: 15px 0 15px 0px;
    display: block;
    text-align: left;}    
ul.gnb li {display:inline-block;margin:0 40px;}    
    
.mfg-logo {position:fixed; display:block;width:200px;top:15px;left:20px; z-index:999999999; }

ul.gnb li img {width:150px;}    
    ul li {margin:0;}
    
.drilldown-container {margin-bottom:24px;}

    
@media only screen and (max-width: 1023px) {
.left-gnb {display:none;}
#top-search {display:none!important;}
.mobile-logo {display:block;margin:0 auto; top:14px; width:80px; position:fixed;    left: 50%;    transform: translateX(-50%); z-index:9999;}   
.mobile-logo img {width:100%;}    

.inner-left {right:20px!important;}
    
}
.menu-search fieldset {display:inline-block; width:200px;}
.menu-search fieldset input {border:0!important; border-bottom:1px solid #000!important;}   
.xans-layout-searchside button.btn.fa-input .material-icons {font-size:20px;}
.social ul li {display:inline-block;float: left;padding-right:8px;}    
svg#Layer_1 {width:12px;}    
    
    
.logbutton {display:block; width: calc(100% - 60px); margin: 0 auto;}
.logbutton li { border:1px solid #000; margin: 10px 0; text-align:center!important; padding-top:0px;}
    
   
ul.logbutton li a {margin-left:0!important;}
  </style>





<div class="mobile-menu-button">
    <a href="#" data-drawer-trigger="" aria-controls="drawer-name-left" aria-expanded="false" style="border:none!important;"><i class="material-icons" style="border-style: none;"><span class="top-menu1">MENU</span></i></a>
  </div>



  <section class="drawer drawer--left" id="drawer-name-left" data-drawer-target=""><div class="drawer__overlay" data-drawer-close="" tabindex="-1"></div>
    <div class="drawer__wrapper">
      <div class="drawer__header">
        <div class="drawer__title">
        </div>
        <button class="drawer__close" data-drawer-close="" aria-label="Close Drawer"></button>
      </div>
      <div class="drawer__content">
<div class="drilldown">
    <div class="drilldown-container">

		
        	<div class="xans-element- xans-layout xans-layout-statelogoff "><div class="top" style="padding-left:30px;">
        			<?
	if(!$cookie_no)
		echo("<tr bgcolor='#F0F0F0'>
		<td width='181' align='center'><font color='#666666'>&nbsp <b>Welcome ! &nbsp;&nbsp 고객님</b></font></td>");
	else
		echo("<tr bgcolor='#F0F0F0'>
		<td width='181' align='center'><font color='#666666'>&nbsp <b>Welcome ! &nbsp;&nbsp $cookie_name </b></font></td>");
?> </span></span></a>                 
				</div>
</div>

			

<div class="divider"></div>
<ul class="accordion"><li>&nbsp;</li>    
 <li><hr size="1 solid #CCC;"></li>

<li><a href="index.html">MAIN</a></li>         
<li><a href="product.php?menu=1">OUTER</a></li>
<li><a href="product.php?menu=2">KNIT</a></li>
<li><a href="product.php?menu=3">SHIRTS</a></li>
<li><a href="product.php?menu=4">SWEATSHIRTS</a></li>
<li><a href="product.php?menu=5">T-SHIRTS</a></li>
<li><a href="product.php?menu=6">BOTTOMS</a></li>
<li><a href="product.php?menu=7">ACCESSORIES</a></li>
<li><a href="product.php?menu=8">LIFESTYLE</a></li>
<li><a href="product.php?menu=9"><span style="color:red;">Sale</span></a></li>
       
 <li><hr size="1 solid #CCC;"></li>     
<li><a href="cart.php">CART</a></li>

                
  <div class="xans-element- xans-layout xans-layout-statelogoff "><ul class="logbutton">
 <?
 if (!$cookie_no){
	 echo("<li><a href='member_login.php' class='log' style='padding-left:0;'>Login</a></li>");
	 echo("<li><a href='member_agree.php' style='padding-left:0;'>Join</a></li>");
 }
 else{
	 echo("<li><a href='member_logout.php' class='log' style='padding-left:0;'>Logout</a></li>");
	 echo("<li><a href='member_edit.php' class='log' style='padding-left:0;'>Account</a></li>");
 }
  ?>
</ul>
</div>
 </ul>      
  </section><script>

    /*!
    * Based on articles on
   
    */

    var drawer = function () {

      /**
      * Element.closest() polyfill
      * https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Polyfill
      */
      if (!Element.prototype.closest) {
        if (!Element.prototype.matches) {
          Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
        }
        Element.prototype.closest = function (s) {
          var el = this;
          var ancestor = this;
          if (!document.documentElement.contains(el)) return null;
          do {
            if (ancestor.matches(s)) return ancestor;
            ancestor = ancestor.parentElement;
          } while (ancestor !== null);
          return null;
        };
      }


      //
      // Settings
      //
      var settings = {
        speedOpen: 50,
        speedClose: 350,
        activeClass: 'is-active',
        visibleClass: 'is-visible',
        selectorTarget: '[data-drawer-target]',
        selectorTrigger: '[data-drawer-trigger]',
        selectorClose: '[data-drawer-close]',

      };


      //
      // Methods
      //

      // Toggle accessibility
      var toggleAccessibility = function (event) {
        if (event.getAttribute('aria-expanded') === 'true') {
          event.setAttribute('aria-expanded', false);
        } else {
          event.setAttribute('aria-expanded', true);
        }   
      };

      // Open Drawer
      var openDrawer = function (trigger) {

        // Find target
        var target = document.getElementById(trigger.getAttribute('aria-controls'));

        // Make it active
        target.classList.add(settings.activeClass);

        // Make body overflow hidden so it's not scrollable
        document.documentElement.style.overflow = 'hidden';

        // Toggle accessibility
        toggleAccessibility(trigger);

        // Make it visible
        setTimeout(function () {
          target.classList.add(settings.visibleClass);
        }, settings.speedOpen); 

      };

      // Close Drawer
      var closeDrawer = function (event) {

        // Find target
        var closestParent = event.closest(settings.selectorTarget),
          childrenTrigger = document.querySelector('[aria-controls="' + closestParent.id + '"');

        // Make it not visible
        closestParent.classList.remove(settings.visibleClass);

        // Remove body overflow hidden
        document.documentElement.style.overflow = '';

        // Toggle accessibility
        toggleAccessibility(childrenTrigger);

        // Make it not active
        setTimeout(function () {
          closestParent.classList.remove(settings.activeClass);
        }, settings.speedClose);             

      };

      // Click Handler
      var clickHandler = function (event) {

        // Find elements
        var toggle = event.target,
          open = toggle.closest(settings.selectorTrigger),
          close = toggle.closest(settings.selectorClose);

        // Open drawer when the open button is clicked
        if (open) {
          openDrawer(open);
        }

        // Close drawer when the close button (or overlay area) is clicked
        if (close) {
          closeDrawer(close);
        }

        // Prevent default link behavior
        if (open || close) {
          event.preventDefault();
        }

      };

      // Keydown Handler, handle Escape button
      var keydownHandler = function (event) {

        if (event.key === 'Escape' || event.keyCode === 27) {

          // Find all possible drawers
          var drawers = document.querySelectorAll(settings.selectorTarget),
            i;

          // Find active drawers and close them when escape is clicked
          for (i = 0; i < drawers.length; ++i) {
            if (drawers[i].classList.contains(settings.activeClass)) {
              closeDrawer(drawers[i]);
            }
          }

        }

      };


      //
      // Inits & Event Listeners
      //
      document.addEventListener('click', clickHandler, false);
      document.addEventListener('keydown', keydownHandler, false);


    };

    drawer();

  </script><div class="logo"><a href="index.html"><img src="images/uniformbridge.png"></a></div>
        	
<script>
    $('#trigger-overlay').on('click', function(){
	$(".overlay").addClass('open');	
});
$('.overlay-close').on('click', function(){
	$(".overlay").removeClass('open');	
});
</script>    
    
   
</div>


		</td>
		<td width="10"></td>
		<td valign="top">
			
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	