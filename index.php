<?php

if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off") {

    $redirect= "https:".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("Location:$redirect");
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BuyMore</title>

    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="bootstrap-social.css"/>
    <link href="mystyles.css" rel="stylesheet"/>
    <link href="incl/admin.css" rel="stylesheet" type="text/css"/>

</head>



<body>

  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainnavbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand logo-link" ui-sref="app"><img src="images/logo.png" height=35 width=80></a>
          </div>
          <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                  <li><a class="active" href="index.php">Home</a>
                  <li><a class="active" href="admin.php">Admin Panel</a></li>
                  <li><a class="active" href="#">About</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li><a class="active" href="login.php"><span>Login</span></a></li>
                  <li><a class="active" href="#">User:
                    <?php
                       if(!empty($_COOKIE['t4210'])){
                         if($t = json_decode(stripslashes($_COOKIE['t4210']),true)) {
                             if($t['em'] == "weiling@ierg4210.com"){
                                echo "Admin";
                             }else{
                                echo "Normal User";
                             }
                         }
                       }else{
                          echo "No User";
                       }
                    ?></a></li>

                   <li><a class="active" href="/auth-process.php?action=logout"><span>Logout</span></a></li>
              </ul>
          </div>
      </div>
  </nav>

  <div class = "header">
    <div class="container">
        <div class="row row-header">
            <div class="col-xs-12 col-sm-8">
                <h1 id="logo">BUY MORE</h1>
                <h3>WELCOME TO YOUR OWN SHOPPING MALL!</h3>
            </div>
            <div class="col-xs-12 col-sm-2">
            </div>
            <div class="col-xs-12 col-sm-2">
            </div>
        </div>
    </div>
  </div>


  <!-- main content -->
  <div class="container">

      <div class="row row-content">
        <div class="col-xs-12 col-sm-2 col-sm-push-9">
          <div class="shoppingList btn">
            <button class="btn" id="listButton">Shopping List</button>
            <div class="dropdown-content">

              <form method="POST" action="<?php echo ($pay_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'); ?>" onsubmit="submitShoppingCart(this)">

                <table id="shopping-cart"></table>
                <input type="hidden" name="cmd" value="_xclick"/>

                <!-- Identify your business so that you can collect the payments. -->
                <input type="hidden" name="business" value="<?php echo ($paypalID='vailydia-facilitator@hotmail.com'); ?>"/>

                <!-- Specify details about the item that buyers will purchase. -->
                <input type="hidden" name="item_name" value="<?php echo ($item='BuyMore Items'); ?>" />

                <input type="hidden" name="lc" value="HK"/>
                <input type="hidden" name="currency_code" value="HKD"/>
                <input type="hidden" name="charset" value="utf-8"/>
                <input type="hidden" name="payer_email" value="0" />

                <!-- get from server side. -->
                <input type="hidden" name="amount" value=0 />
                <input type="hidden" name="custom" value="0"/>
                <input type="hidden" name="invoice" value="0"/>

                <p id="sum"></p>
                <input id="btncheckout" type="submit" value="Checkout"/>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row row-content">

  <!-- navigation list(leftsize) -->
          <div class="col-xs-12 col-sm-3">
            <nav>
                <div class="container-fluid">
                    <ul id="subnavbar" class="nav nav-pills nav-stacked">

                    </ul>
                </div>
            </nav>
          </div>
   <!-- breadcrumb -->
          <div class="col-xs-12 col-sm-7">

            <div class="row">
                <div class="col-xs-12">
                   <ul id="breadcrumbDetails" class="breadcrumb">

                   </ul>
                </div>
            </div>

            <div class = "contentright">
              <ul id="productListDetails" class="productTable">

              </ul>
            </div>


          </div>

      </div>

      <!-- test the admin panel -->
      <div class="row row-content">
        <div id="adminPaneldiv">
          <!--
          <button id = "adminPanel" class="btn" data-toggle="modal" data-target="#myModal">
          	Open Admin Panel
          </button>
          -->
          <div id="adminPanel">
          	<a href="admin.php">Open Admin Panel</a>
          </div>

          <!--

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          	<div class="modal-dialog">
          		<div class="modal-content">
          			<div class="modal-header">
          				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          					&times;
          				</button>
          				<h4 class="modal-title" id="myModalLabel">
          					Admin Panel
          				</h4>
          			</div>
          			<div class="modal-body">

                  <section id="categoryPanel">
                    <fieldset>
                      <legend>New Category</legend>
                      <form id="cat_insert" method="POST" action="admin-process.php?action=cat_insert" onsubmit="return false;">
                        <label for="cat_name">Name *</label>
                        <div><input id="cat_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>
                        <input type="submit" value="Submit" />
                      </form>
                    </fieldset>


                    <h3>All categories in the database are :</h>
                    <ul id="categoryList"></ul>

                  </section>

                  <section id="categoryEditPanel" class="hide">
                    <fieldset>
                      <legend>Editing Category</legend>
                      <form id="cat_edit" method="POST" action="admin-process.php?action=cat_edit" onsubmit="return false;">
                        <label for="cat_edit_name">Name *</label>
                        <div><input id="cat_edit_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>
                        <input type="hidden" id="cat_edit_catid" name="catid" />
                        <input type="submit" value="Submit" />
                        <input type="button" id="cat_edit_cancel" value="Cancel" />
                      </form>
                    </fieldset>
                  </section>


                  <section id="productPanel">
                    <fieldset>
                      <legend>New Product</legend>
                      <form id="prod_insert" method="POST" action="admin-process.php?action=prod_insert" enctype="multipart/form-data">
                        <label for="prod_insert_catid">Category *</label>
                        <div><select id="prod_insert_catid" name="catid"></select></div>

                        <label for="prod_insert_name">Name *</label>
                        <div><input id="prod_insert_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>

                        <label for="prod_insert_price">Price *</label>
                        <div><input id="prod_insert_price" type="number" name="price" required="true" pattern="^[\d\.]+$" /></div>

                        <label for="prod_insert_description">Description</label>
                        <div><textarea id="prod_insert_description" name="description" pattern="^[\w\-\. ]+$"></textarea></div>

                        <label for="prod_insert_name">Image *</label>
                        <div><input type="file" name="file" required="true" accept="image/jpeg" /></div>

                        <input type="submit" value="Submit" />
                      </form>
                    </fieldset>

                    <h3>Products in the database are :</h>

                    <ul id="productList"></ul>

                  </section>

                  <section id="productEditPanel" class="hide">


                      <fieldset>
                        <legend>Edit Product</legend>
                        <form id="prod_edit" method="POST" action="admin-process.php?action=prod_edit" enctype="multipart/form-data">
                          <label for="prod_edit_catid">Category *</label>
                          <div><select id="prod_edit_catid" name="catid"></select></div>

                          <label for="prod_edit_name">Name *</label>
                          <div><input id="prod_edit_name" type="text" name="name" required="true" pattern="^[\w\- ]+$" /></div>

                          <label for="prod_edit_price">Price *</label>
                          <div><input id="prod_edit_price" type="number" name="price" required="true" pattern="^[\d\.]+$" /></div>

                          <label for="prod_edit_description">Description</label>
                          <div><textarea id="prod_edit_description" name="description" pattern="^[\w\-\. ]+$"></textarea></div>

                          <label for="prod_insert_name">Image *</label>
                          <div><input type="file" name="file" required="true" accept="image/jpeg" /></div>

                          <input type="hidden" id="prod_edit_pid" name="pid" />
                          <input type="submit" value="Submit" />
                          <input type="button" id="prod_edit_cancel" value="Cancel" />

                          <input type="submit" value="Submit" />
                        </form>

                      </fieldset>

                  </section>

                  <div class="clear"></div>

          			</div>
          			<div class="modal-footer">
          				<button type="button" class="btn btn-default" data-dismiss="modal">CLOSE
          				</button>

          			</div>
          		</div>
          	</div>
          </div>
          -->
        </div>
      </div>

  </div>



  <footer class="row-footer">
      <div class="container">
          <div class="row">
              <div class="col-xs-12 col-sm-6 col-xs-push-3">
                  <h5>Our Address</h5>
                  <address>
                12345, Shopping Road<br>
                Fanling, HONG KONG<br>
                <i class="fa fa-phone"></i>: +852 1234 5678<br>
                <i class="fa fa-envelope"></i>:
                       <a href="mailto:buymore@shopping.net">
                       buymore@shopping.net</a>
                  </address>
              </div>

              <div class="col-xs-12 col-sm-6">

                  <div>
                      <br><br><br><br>
                      <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><i class="fa fa-facebook"></i></a>
                      <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i class="fa fa-twitter"></i></a>
                      <a class="btn btn-social-icon btn-youtube" href="http://youtube.com/"><i class="fa fa-youtube"></i></a>
                  </div>
              </div>
              <div class="col-xs-12">
                  <p align=center>© Copyright 2017 Buy More</p>
              </div>
          </div>
      </div>
  </footer>

<script src="bower_components/jquery/dist/jquery.min.js" rel="stylesheet" type = "text/javascript"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="incl/myLib.js" type = "text/javascript"></script>
<script src="myjs.js" type = "text/javascript"></script>

</body>


</html>
