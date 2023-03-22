<?php
    session_start();
    
    include('layout/header.php');

    $users_search = $_SESSION['search'];
    // echo $users_search;
?>
   
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper white hide-on-med-and-down">
                <a href="index.php" class="brand-logo pink-text hide-on-med-and-down"><i class="material-icons" id="logo1">business</i>Shop Finder</a>
                <ul class="right hide-on-med-and-down">
                    <li id="forthForm" class="black-text">
                        <?php
                            // start session
                            require('../shopFinderDbConfig.php');

                            $res = $db->query('SELECT * FROM choosedplacefile WHERE exactPlace = "'.$users_search.'" ORDER BY datePosted DESC');

                            $numRows = $res->num_rows;

                            if($numRows > 0){
                                $rows = $res->fetch_assoc();

                                $search = $rows['choosedPlaceAddress'];
                                // echo $search;
                                // $checkInDate = $rows['checkInDate'];
                                // $checkOutDate = $rows['checkOutDate'];
                                // $addGuestInput = $rows['addGuestInput'];
                            }
                        ?>
                        <form method="POST" class="formSearchLocate">
                            <div class="thirdFormContain" id="thirdFormContain">
                                <div class="input-field">
                                    <input type="search" class="black-text validate search" id="search1" name="search" placeholder="Start your search" required>
                                    <!-- <input type="search" class="black-text" id="thirdFormSearch" name="thirdFormSearch" placeholder="Start your search" required> -->
                                    <!-- <span class="hide-on-small-only loc"></span> -->
                                </div>
                                
                                <button type="submit" class="btn-floating btn-small pink waves-effect waves-light right" name="searchBtn" id="searchBtn3">
                                    <i class="material-icons" id="thirdFormIcon">search</i>
                                </button>

                                <div class="display z-depth-1" id="display1"></div>
                            </div>
                        </form>
                    </li>

                    <li>
                        <!-- About Navbar Link -->
                        <!-- Shops Dropdown Trigger -->
                        <a class='dropdown-trigger scrollableNavLink' href='#' data-target='aboutDrop'>About us</a>

                        <!-- Shops Dropdown Structure -->
                        <ul id='aboutDrop' class='dropdown-content'>
                            <li><a href="about.php" class="black-text">About</a></li>
                            <li class="divider" tabindex="-1"></li>
                            <li><a href="contact.php" class="black-text">Contact</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <!-- Shops Navbar Link -->
                        <!-- Shops Dropdown Trigger -->
                        <a class='dropdown-trigger scrollableNavLink' href='#' data-target='shopsDrop'>Shops</a>

                        <!-- Shops Dropdown Structure -->
                        <ul id='shopsDrop' class='dropdown-content'>
                            <li><a href="#" <?= $africa = 'africa' ?> class="black-text africaShopResultBtn">Africa</a></li>
                            <li class="divider" tabindex="-1"></li>
                            <li><a href="#!" <?= $asia = 'asia' ?> class="black-text asiaShopResultBtn">Asia</a></li>
                        </ul>
                    </li>

                    <li>
                        <!-- Blog Navbar Link -->
                        <!-- Blog Dropdown Trigger -->
                        <a class='scrollableNavLink' href='blog.php'>Blog</a>

                        <!-- Blog Dropdown Structure -->
                        <!-- <ul id='blogDrop' class='dropdown-content'>
                            <li><a href="#!" class="black-text">Blog & News</a></li>
                        </ul> -->
                    </li>

                    <li>
                        <!-- Login/Register  -->
                        <?php
                            if(isset($_SESSION['loggedIn'])){
                    
                                echo '
                                        <!-- Username Modal Trigger -->
                                        <a href="#" style="display: flex;" class="dropdown-trigger scrollableNavLink" data-target="userTypeDropdown1">
                                            '.$_SESSION["name"].'
                                            <i class="material-icons black-text">account_circle</i>
                                        </a>
                                    ';
                            } else {
                                echo '  
                                        <!-- Auth Modal Trigger -->
                                        <a class="modal-trigger scrollableNavLink" href="#authModal">
                                            Login/Register
                                        </a>
                                    ';
                            }
                        ?>

                        <!-- UserType Dropdown Structure -->
                        <ul id='userTypeDropdown1' class='dropdown-content'>
                            <?php
                                if(isset($_SESSION['loggedIn'])){
                                    $feedbackUserId = $_SESSION['feedbackUserId'];
                                    $userType = $_SESSION['userType'];
                                    if($userType == 'admin'){
                                        echo '<li>
                                                <a class="modal-trigger black-text" href="#modal1">
                                                    Register Shop
                                                </a>
                                            </li>';
                                    } else if ($userType == 'vendor') {
                                        echo '<li>
                                                <a href="dashboard.php" class="black-text">Dashboard</a>
                                            </li>';
                                    } else if ($userType == 'client') {
                                        echo '<li>
                                                <a href="#" class="black-text">Client</a>
                                            </li>';
                                    }
                                }
                            ?>
                            <li class="divider" tabindex="-1"></li> 
                            <li><a href="./logout.php" class="black-text">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Auth Modal Structure -->
        <div id="authModal" class="modal">
            <div class="modal-content">
                <!-- Login Modal Structure -->
                <div id="authMsgResult" style="color: red;"></div>
                <div id="logModalDiv">
                    <h5>Login</h5>
                    <form action="" id="loginForm" method="POST">
                        <div class="row">
                            <div class="col s12 input-field">
                                <label for="logEmail">Email</label>
                                <input type="email" class="validate" name="logEmail" id="logEmail" required /> 
                            </div>
                            <div class="col s12 input-field">
                                <label for="logPass">Password</label>
                                <input type="password" class="validate" name="logPass" id="logPass" required /> 
                            </div>
                            
                            <div class="input-field">
                                <button class="btn waves-effect waves-light col s12 center" type="submit" id="logBtn" name="logBtn">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>

                            <p class="center">Don't have an account? <a href="#" id="logSwapBtn">Register</a></p>
                        </div>
                    </form>
                </div>

                <!-- Registry Modal Structure -->
                <div id="regModalDiv" class="hide">
                    <h5>Registration</h5>
                    <form action="" id="regForm" method="POST">
                        <div class="row">
                            <div class="col s6 input-field">
                                <label for="fName">Firstname</label>
                                <input type="text" class="validate" name="fName" id="fName" required/> 
                            </div>
                            <div class="col s6 input-field">
                                <label for="regLName">Lastname</label>
                                <input type="text" class="validate" name="regLName" id="regLName" required/> 
                            </div>
                            <div class="col s6 input-field">
                                <label for="oName">Othername</label>
                                <input type="text" class="validate" name="oName" id="oName" /> 
                            </div>
                            <div class="col s6 input-field">
                                <label for="phone">phone</label>
                                <input type="number" class="validate" name="phone" id="phone" required/> 
                            </div>
                            <div class="col s12 input-field">
                                <label for="email">Email</label>
                                <input type="email" class="validate" name="email" id="email" required/> 
                            </div>
                            <div class="col s6 input-field">
                                <label for="pass">Password</label>
                                <input type="password" class="validate" name="pass" id="pass" required/> 
                            </div>
                            <div class="col s6 input-field">
                                <label for="cPass">Confirm Password</label>
                                <input type="password" class="validate" name="cPass" id="cPass" required/> 
                            </div>
                            <div class="input-field">
                                <button class="btn waves-effect waves-light col s12 center" type="submit" id="regBtn" name="regBtn">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>

                            <p class="center">Already have an account? <a href="#" id="regSwapBtn">Login</a></p>
                        </div>
                    </form>
                </div>
                
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
            </div>
        </div>

        <!-- Admin Host Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h5>Tell us more about the shop and we'll update it for you</h5>
                <!-- <p>A bunch of text</p> -->
                <form action="" id="usersHostingForm" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- <div class="col s6 input-field">
                            <label for="addr">Address/Continent</label>
                            <input type="text" class="validate" name="addr" id="addr" require /> 
                        </div> -->
                        <div class="input-field col s6">
                            <select class="validate" id="addr" name="addr">
                                <option value="" disabled selected>Choose a Continent</option>
                                <option>Asia</option>
                                <option>Africa</option>
                            </select>
                        </div>
                        <div class="col s6 input-field">
                            <label for="exact">Exact Shop's Location</label>
                            <input type="text" class="validate" name="exact" id="exact" require /> 
                        </div>
                        <div class="col s6 input-field">
                            <label for="title">Title</label>
                            <input type="text" class="validate" name="title" id="title" require /> 
                        </div>
                        <div class="col s6 input-field">
                            <label for="houseD">Shop Description</label>
                            <input type="text" class="validate" name="houseD" id="houseD" require /> 
                        </div>
                        <div class="file-field input-field col s6">
                            <div class="btn">
                                <span>Pick File</span>
                                <input type="file" name="file" id="file" multiple>
                                
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" multiple>
                            </div>
                        </div>
                        <div class="col s6 input-field">
                            <label for="price">Shop's GPS Location Link</label>
                            <input type="text" class="validate" name="price" id="price" require /> 
                        </div>
                        <div class="input-field">
                            <button class="btn waves-effect waves-light col s12 center" type="submit" id="fileUpload" name="fileUpload">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
            </div>
        </div>

    </div>
    <div class="row gpsContain"> 
        <!-- User's search result -->
        <div class="col s12 m12 l5" id="locSelectDiv">
            
            <!-- Search engine shop results -->
            <div id="searchEngineShopResultDiv">
                <br><br>
                300+ shops
                <p id="searchResPara">Shops in <?php echo strtolower($search); ?></p>   
                <?php 
                    // Display result typed on the search engine
                    $dbArr = [];
                        
                    $res1 = $db->query('SELECT * FROM choosedplacefile WHERE exactPlace = "'.$users_search.'"  AND dateDeleted IS NULL ORDER BY datePosted DESC');

                    $numRows1 = $res1->num_rows;

                    if($numRows1 > 0){
                        $check1 = strtolower($users_search);
                        
                        while($rows1 = $res1->fetch_assoc()){
                            $img = $rows1['files'];
                            $check = $rows1['exactPlace'];
                            $check2 = strtolower($check);
                            
                            if($check1 == $check2){
                                array_push($dbArr, $rows1);    
                            } 
                        }
                        foreach($dbArr as $dbDisplay){

                            $gps = $dbDisplay['price'];
                            
                            
                            echo '<button type="button" class="waves-effect waves-light gpsLocBtn" data-id="'.$dbDisplay['id'].'" data-value="'.$dbDisplay['price'].'">';
                                echo'<div class="row">
                                    
                                        <div class="col s6">
                                            <img src="media/'.$dbDisplay['files'].'" alt="'.$dbDisplay['files'].'" class="responsive-img resultImg">
                                        </div>
                                        
                                        <div class="col s6" id="houseDetails">
                                            <span id="title">'.$dbDisplay['title'].'</span>
                                            <br />  
                                            <span id="exactPlace">'.$dbDisplay['exactPlace'].'</span>
                                            <br />
                                            <hr id="hRow">
                                            <span id="houseD">'.$dbDisplay['houseDescription'].'</span>
                                            <br />
                                            <p class="shopTimeFunc">
                                                <span class="shopTimeFunc1">Open</span> . Untill 11pm
                                            </p>
                                            
                                            
                                            <a href="#" data-target="slideOut" class="sidenav-trigger giveFeedbackSidenavTrigg1">Give feedback</a>
                                            <a href="#" class="giveFeedbackDelBtn" data-id="'.$dbDisplay['id'].'" data-value="'.$dbDisplay['files'].'">Delete</a>
                                            
                                        </div>
                                        
                                    </div>';
                                echo '<hr id="hRow1">';
                            echo '</button>';
                        }
                    
                    } else {
                        echo 'No files yet.';
                    }
                    
                    // Display all results in the choosed Continent
                    $dbArr = [];

                    $africa;
                    $asia;
                    // echo $africa;

                    $res2 = $db->query('SELECT * FROM choosedplacefile WHERE choosedPlaceAddress = "'.$search.'" AND dateDeleted IS NULL ORDER BY datePosted DESC');

                    $numRows2 = $res2->num_rows;

                    if($numRows2 > 0){
                        $checked = strtolower($search);
                        
                        while($rows2 = $res2->fetch_assoc()){
                            // $img = $rows2['files'];
                            // $checked = $rows2['exactPlace'];
                            // $checked2 = strtolower($checked);
                            
                            // if($checked == $checked2){
                                array_push($dbArr, $rows2);    
                            // } 
                        }
                        foreach($dbArr as $dbDisplay){

                            $gps = $dbDisplay['price'];
                            // $shopId = $dbDisplay['id'];
                            
                            echo '<button type="button" class="waves-effect waves-light gpsLocBtn" data-id="'.$dbDisplay['id'].'" data-value="'.$dbDisplay['price'].'">';
                                echo'<div class="row">
                                    
                                        <div class="col s6">
                                            <img src="media/'.$dbDisplay['files'].'" alt="'.$dbDisplay['files'].'" class="responsive-img resultImg">
                                        </div>
                                        
                                        <div class="col s6" id="houseDetails">
                                            <span id="title">'.$dbDisplay['title'].'</span>
                                            <br />  
                                            <span id="exactPlace">'.$dbDisplay['exactPlace'].'</span>
                                            <br />
                                            <hr id="hRow">
                                            <span id="houseD">'.$dbDisplay['houseDescription'].'</span>
                                            <br />
                                            <p class="shopTimeFunc">
                                                <span class="shopTimeFunc1">Open</span> . Untill 11pm
                                            </p>

                                            <a href="#" data-target="slideOut" class="sidenav-trigger giveFeedbackSidenavTrigg1">Give feedback</a>
                                            <a href="#" class="giveFeedbackDelBtn" data-id="'.$dbDisplay['id'].'" data-value="'.$dbDisplay['files'].'">Delete</a>
                                            
                                        </div>
                                        
                                    </div>';
                                echo '<hr id="hRow1">';
                            echo '</button>';
                        }
                    
                    } else {
                        echo 'No files yet.';
                    }
                ?>
            </div>

            <!-- On clicked Africa shop results -->
            <div class="hide" id="africaShopResultDiv">
                <br><br>
                300+ shops
                <p id="searchResPara">Shops in africa</p>  
                <?php 
                    // Display all results in the choosed Continent
                    $dbArr = [];

                    $africa;
                    // $asia;
                    // echo $africa;

                    $res2 = $db->query('SELECT * FROM choosedplacefile WHERE choosedPlaceAddress = "'.$africa.'" AND dateDeleted IS NULL ORDER BY datePosted DESC');

                    $numRows2 = $res2->num_rows;

                    if($numRows2 > 0){
                        $checked = strtolower($search);
                        
                        while($rows2 = $res2->fetch_assoc()){
                            // $img = $rows2['files'];
                            // $checked = $rows2['exactPlace'];
                            // $checked2 = strtolower($checked);
                            
                            // if($checked == $checked2){
                                array_push($dbArr, $rows2);    
                            // } 
                        }
                        foreach($dbArr as $dbDisplay){

                            $gps = $dbDisplay['price'];
                            
                            echo '<button type="button" class="waves-effect waves-light gpsLocBtn" data-id="'.$dbDisplay['id'].'" data-value="'.$dbDisplay['price'].'">';
                                echo'<div class="row">
                                    
                                        <div class="col s6">
                                            <img src="media/'.$dbDisplay['files'].'" alt="'.$dbDisplay['files'].'" class="responsive-img resultImg">
                                        </div>
                                        
                                        <div class="col s6" id="houseDetails">
                                            <span id="title">'.$dbDisplay['title'].'</span>
                                            <br />  
                                            <span id="exactPlace">'.$dbDisplay['exactPlace'].'</span>
                                            <br />
                                            <hr id="hRow">
                                            <span id="houseD">'.$dbDisplay['houseDescription'].'</span>
                                            <br />
                                            <p class="shopTimeFunc">
                                                <span class="shopTimeFunc1">Open</span> . Untill 11pm
                                            </p>

                                            <a href="#" data-target="slideOut" class="sidenav-trigger giveFeedbackSidenavTrigg1">Give feedback</a>
                                            <a href="#" class="giveFeedbackDelBtn" data-id="'.$dbDisplay['id'].'" data-value="'.$dbDisplay['files'].'">Delete</a>
                                            
                                        </div>
                                        
                                    </div>';
                                echo '<hr id="hRow1">';
                            echo '</button>';
                        }
                    
                    } else {
                        echo 'No files yet.';
                    }
                ?>
            </div>

            <!-- On clicked Asia shop results -->
            <div class="hide" id="asiaShopResultDiv">
                <br><br>
                300+ shops
                <p id="searchResPara">Shops in asia</p>
                <?php 
                    // Display all results in the choosed Continent
                    $dbArr = [];

                    // $africa;
                    $asia;
                    // echo $asia;

                    $res2 = $db->query('SELECT * FROM choosedplacefile WHERE choosedPlaceAddress = "'.$asia.'" AND dateDeleted IS NULL ORDER BY datePosted DESC');

                    $numRows2 = $res2->num_rows;

                    if($numRows2 > 0){
                        $checked = strtolower($search);
                        
                        while($rows2 = $res2->fetch_assoc()){
                            // $img = $rows2['files'];
                            // $checked = $rows2['exactPlace'];
                            // $checked2 = strtolower($checked);
                            
                            // if($checked == $checked2){
                                array_push($dbArr, $rows2);    
                            // } 
                        }
                        foreach($dbArr as $dbDisplay){

                            $gps = $dbDisplay['price'];
                            
                            echo '<button type="button" class="waves-effect waves-light gpsLocBtn" data-id="'.$dbDisplay['id'].'" data-value="'.$dbDisplay['price'].'">';
                                echo'<div class="row">
                                    
                                        <div class="col s6">
                                            <img src="media/'.$dbDisplay['files'].'" alt="'.$dbDisplay['files'].'" class="responsive-img resultImg">
                                        </div>
                                        
                                        <div class="col s6" id="houseDetails">
                                            <span id="title">'.$dbDisplay['title'].'</span>
                                            <br />  
                                            <span id="exactPlace">'.$dbDisplay['exactPlace'].'</span>
                                            <br />
                                            <hr id="hRow">
                                            <span id="houseD">'.$dbDisplay['houseDescription'].'</span>
                                            <br />
                                            <p class="shopTimeFunc">
                                                <span class="shopTimeFunc1">Open</span> . Untill 11pm
                                            </p>

                                            <a href="#" data-target="slideOut" class="sidenav-trigger giveFeedbackSidenavTrigg1">Give feedback</a>
                                            <a href="#" class="giveFeedbackDelBtn" data-id="'.$dbDisplay['id'].'" data-value="'.$dbDisplay['files'].'">Delete</a>
                                            
                                        </div>
                                        
                                    </div>';
                                echo '<hr id="hRow1">';
                            echo '</button>';
                        }
                    
                    } else {
                        echo 'No files yet.';
                    }
                ?>
            </div>
            
        </div>

        <!-- User's Vender's Feedback Section -->
        <ul id="slideOut" class="sidenav">
            <div class="feedbackSidenavTxtDiv">
                <p class="feedbackSidenavTxt">Feedback</p>
                <i class="material-icons sidenav-close giveFeedbackCloseIcon">close</i>
            </div>

            <div class="divider"></div>
            
            <li>
                <form id="feedbackForm">
                    <div class="feedbackBoxMsg">
                        <p class="feedbackBoxTxt center">Your feedback matters! Help us improve the Shop Finder website</p>
                        <div class="center feedbackInnerBox">
                            <i class="material-icons feedbackIcon" id="feedbackIcon" data-feed="1" name="feedbackIcon">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon" data-feed="1" name="feedbackIcon">star</i>
                        
                            <i class="material-icons feedbackIcon" id="feedbackIcon1" data-feed="2" name="feedbackIcon">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon1" data-feed="2" name="feedbackIcon">star</i>
                        
                            <i class="material-icons feedbackIcon" id="feedbackIcon2" data-feed="2" data-feed="3" name="feedbackIcon">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon2" data-feed="3" name="feedbackIcon">star</i>
                        
                            <i class="material-icons feedbackIcon" id="feedbackIcon3" data-feed="4" name="feedbackIcon">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon3" data-feed="4" name="feedbackIcon">star</i>
                        
                            <i class="material-icons feedbackIcon" id="feedbackIcon4" data-feed="5" name="feedbackIcon">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon4" data-feed="4" name="feedbackIcon">star</i>

                            <i class="material-icons feedbackIcon hide" id="feedbackIcon5">star_border</i>
                        </div>

                        <p class="feedbackBoxMsg1 center">(1 = Very poor, 5 = Excellent)</p>

                        <div class="hide feedbackTxtBox">
                            <div class="feedbackTxtAreaPointer"></div>
                            <div class="hide feedbackTxt1">Sorry to hear it. What was the problem?</div>
                            <textarea name="feedbackTxtArea" class="feedbackTxtArea" placeholder="Please tell us more (Max 300 characters)"></textarea>
                        </div>
                    </div>

                    <input type="hidden" value="<?= $feedbackUserId ?>" id="feedbackUserId">

                    
                    <input type="hidden" value="<?= $shopId ?>" id="shopId">
                    
                    <div class="feedbackFormBtnMainDiv">
                        <div class="divider"></div>

                        <div class="feedbackFormBtnDiv">
                            <button type="submit" class="btn feedbackFormBtn" id="feedbackFormBtn" name="feedbackFormBtn">Share with Shop Finder</button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>

        <!-- Map -->
        <div class="col s12 m12 l7 hide-on-med-and-down" id="map">
            <iframe src="<?= $gps ?>"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="gpsLocImg"></iframe>
        </div>

    </div>

    <div class="feedbackDiv center">
        <p class="giveFeedbackTxt">We’d love to hear what you think!</p>

        <a href="#" data-target="slide-out" class="sidenav-trigger giveFeedbackSidenavTrigg">Give feedback</a>

        <ul id="slide-out" class="sidenav">
            <div class="feedbackSidenavTxtDiv">
                <p class="feedbackSidenavTxt">Feedback</p>
                <i class="material-icons sidenav-close giveFeedbackCloseIcon">close</i>
            </div>

            <div class="divider"></div>
            
            <li>
                <form>
                    <div class="feedbackBoxMsg">
                        <p class="feedbackBoxTxt center">Your feedback matters! Help us improve the Shop Finder website</p>
                        <div class="center feedbackInnerBox">
                            <i class="material-icons feedbackIcon" id="feedbackIcon">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon">star</i>
                        
                            <i class="material-icons feedbackIcon" id="feedbackIcon1">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon1">star</i>
                        
                            <i class="material-icons feedbackIcon" id="feedbackIcon2">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon2">star</i>
                        
                            <i class="material-icons feedbackIcon" id="feedbackIcon3">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon3">star</i>
                        
                            <i class="material-icons feedbackIcon" id="feedbackIcon4">star_border</i>
                            <i class="material-icons feedbackIcon hide" id="feedbackClickedIcon4">star</i>

                            <i class="material-icons feedbackIcon hide" id="feedbackIcon5">star_border</i>
                        </div>

                        <p class="feedbackBoxMsg1 center">(1 = Very poor, 5 = Excellent)</p>

                        <div class="hide feedbackTxtBox">
                            <div class="feedbackTxtAreaPointer"></div>
                            <div class="hide feedbackTxt1">Sorry to hear it. What was the problem?</div>
                            <textarea name="feedbackTxtArea" class="feedbackTxtArea" placeholder="Please tell us more (Max 300 characters)"></textarea>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>
        
<?php
    include('layout/footer.php');
?>