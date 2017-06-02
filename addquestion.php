<?php
    include_once 'config.php';
    include_once 'product_model.php';
    include_once 'course_model.php';
    include_once 'difficulty_model.php';

    $difficultyModel = new difficulty_model();
    $difficultyArray = $difficultyModel->viewDifficulty();

    $category_model = new category_model();
    $categoryArray = $category_model->viewCategory(); 

    $product_model = new product_model();
    
    $id = (isset($_GET['id']) && $_GET['id'] > 0) ? $_GET['id'] : 0;
    
    if ($_POST) {
        $postData = array('Question' =>$_POST['question'],'OptionA' => $_POST['optionA'],'OptionB' => $_POST['optionB'],'OptionC' => $_POST['optionC'],'OptionD' => $_POST['optionD'],'Answer' => $_POST['answer']);
        $product_model->addProduct($postData);
    
    }
    $productArray = $product_model->viewProduct(); 
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Questions</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand">Online Exam</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo $_SESSION['fname']; ?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="profile.php?id=<?php echo $_SESSION['id']; ?>"><i class="icon-eye-open"></i> Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="logout.php"><i class="icon-off"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li>
                                <a href="index.php">Dashboard</a>
                            </li>                            
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Questions <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="addquestion.php">Add Quetions</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="question.php">Manage Quetions</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="index.php">User List</a>
                                    </li>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <!--span-->
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li>
                            <a href="index.php"><i class="icon-chevron-right"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="course.php"><i class="icon-chevron-right"></i> Courses</a>
                        </li>
                        <li>
                            <a href="difficulty.php"><i class="icon-chevron-right"></i> Difficulty Types</a>
                        </li>
                        <li class="active">
                            <a href="question.php"><i class="icon-chevron-right"></i> Questions </a>
                        </li>
                    </ul>
                </div>
                
                <!--/span-->
                <div class="span9" id="content">
                  <div class="row-fluid">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <ul class="breadcrumb">
                                        <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <li class="active">
                                            <a href="index.php">Questions</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                  </div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Add Questions</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                     <form class="form-horizontal" method="POST">
                                     <input type="hidden" name="id" value="<?php echo $id; ?>" >
                                      <fieldset>
                                        <legend>Add Questions</legend>
                                        <div class="control-group">
                                          <label class="control-label">Course<span class="required">*</span></label>
                                            <div class="controls">
                                                <select name="course" value="">
                                                  <option>--Select the Course--</option>
                                                  <?php foreach ($categoryArray as $key => $categoryValue) {?>
                                                    <option value="<?php echo $categoryValue['CategoryId']; ?>" <?php echo ($id && $productArray[$id]['CategoryId']==$categoryValue['CategoryId']) ? 'selected' : ''; ?> > <?php echo $categoryValue['Name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Difficulty Type<span class="required">*</span></label>
                                            <div class="controls">
                                                <select name="difficulty" value="<?php echo $id ? $productArray[$id]['DifficultyId'] : '';?>">
                                                  <option>--Select the Difficulty Level--</option>
                                                    <?php foreach ($difficultyArray as $key => $difficultyValue) { ?>
                                                        <option value="<?php echo $difficultyValue['DifficultyId']; ?>" <?php echo ($id && $productArray[$id]['DifficultyId']==$difficultyValue['DifficultyId']) ? 'selected' : ''; ?>><?php echo $difficultyValue['Name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="focusedInput">Question</label>
                                            <div class="controls">
                                                <textarea class="input-xlarge focused" name="question" id="focusedInput" placeholder="Write the question..." style="margin: 0px; width: 473px; height: 115px"><?php echo $id ? $productArray[$id]['Question'] : '';?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">OptionA<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="optionA" data-required="1" class="span3 m-wrap" value="<?php echo $id ? $productArray[$id]['OptionA'] : '';?>" placeholder="Write OptionA" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">OptionB<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="optionB" data-required="1" class="span3 m-wrap" value="<?php echo $id ? $productArray[$id]['OptionB'] : '';?>" placeholder="Write OptionB"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">OptionC<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="optionC" data-required="1" class="span3 m-wrap" value="<?php echo $id ? $productArray[$id]['OptionC'] : '';?>" placeholder="Write OptionC"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">OptionD<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="optionD" data-required="1" class="span3 m-wrap" value="<?php echo $id ? $productArray[$id]['OptionD'] : '';?>" placeholder="Write OptionD"/>
                                            </div>
                                        </div>                                        
                                        <div class="control-group">
                                          <label class="control-label">Answer<span class="required">*</span></label>
                                            <div class="controls">
                                                <select name="answer" value="<?php echo $id ? $productArray[$id]['Answer'] : '';?>">
                                                  <option>--Select the Answer--</option>
                                                  <option value="1" <?php echo ($id && $productArray[$id]['Answer']==1) ? 'selected' : ''; ?>>OptionA</option>
                                                  <option value="2" <?php echo ($id && $productArray[$id]['Answer']==2) ? 'selected' : ''; ?>>OptionB</option>
                                                  <option value="3" <?php echo ($id && $productArray[$id]['Answer']==3) ? 'selected' : ''; ?>>OptionC</option>
                                                  <option value="4" <?php echo ($id && $productArray[$id]['Answer']==4) ? 'selected' : ''; ?>>OptionD</option>
                                                </select>
                                            </div>
                                        </div>   
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary"><?php echo $id ? 'Update':'Add Question'; ?></button>
                                          <button type="reset" class="btn">Reset</button>
                                          <a href="addquestion.php"> <button type="button" class="btn">Cancel</button> </a>
                                        </div>
                                    </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>     
            </div>    
            <hr>
            <footer>
                <p>&copy; Sarthak Shah 2017</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <link href="vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/jquery.uniform.min.js"></script>
        <script src="vendors/chosen.jquery.min.js"></script>
        <script src="vendors/bootstrap-datepicker.js"></script>

        <script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

	<script type="text/javascript" src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="assets/form-validation.js"></script>
        
	<script src="assets/scripts.js"></script>
        <script>

	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
	

        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>
    </body>

</html>