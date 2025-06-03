<?php
    if (!isset($_GET['employid'])) {
        header("Location: ../index");
        exit();
    }
    include '../php/session.php';
    if (!isset($_SESSION['employ'])) {
        header("Location: ../index");
        exit();
    }
    $employ_data = $_SESSION['employ'];
    if ($_GET['employid'] != $employ_data['employ_id']) {
        header("Location: ../index");
        exit();
    }
?>
<!DOCTYPE html>
<html lang='ar'>
    <head>
        <!-- meta -->
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='description' content='this system is private property'>
        <!-- link icon -->
        <link rel='icon' href='../img/Roaya_icon.png'>
        <!-- link css -->
        <link rel='stylesheet' href='../css/style.css'>
        <link rel='stylesheet' href='../css/staff_data.css'>
        <link rel='stylesheet' href='../css/menu.css'>
        <link rel='stylesheet' href='../css/all.min.css'>
        <link rel='stylesheet' href='../css/bootstrap.css'>
        <title>Roaya Pay</title>
    </head>
    <body>
    <?php 
            include '../inc/config.php';
            $IDuse = $_GET['employid'];
            $item = mysqli_query($conection, "SELECT * FROM employs WHERE employ_id=$IDuse");
            $employ = mysqli_fetch_array($item);
        ?>
        <!-- header -->
        <div class='header'>
            <div>
                <a href='../index' class='navbar-brand'>
                    <img src='../img/Roaya.png' alt='' draggable='false'>
                </a>
                <div id='nav'> 
                    <div class='collapse navbar-collapse mx-2'>
                        <div>
                            <div class='dropdowns'>
                                <div class='dropdown mx-2 my-2'>
                                    <button class='btn dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
                                        <span id='employ_Name_Show'></span>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item' id="name" onclick="copyToClipboard(this.id)">
                                            <i class="fa-regular fa-user"></i>
                                            <p class='mx-2'>
                                                <?php echo $employ['employ_name']?>
                                            </p>
                                        </a>
                                        <div class='dropdown-divider m-0'></div>
                                        <a class='dropdown-item' id="email" onclick="copyToClipboard(this.id)">
                                            <i class="fa-regular fa-envelope"></i>
                                            <p class='mx-2'>
                                                <?php echo $employ['employ_email']?>
                                            </p>
                                        </a>
                                        <div class='dropdown-divider m-0'></div>
                                        <a class='dropdown-item bg-danger text-center text-light' style="cursor: pointer; border-radius: 0 0 3.5px 3.5px;" id="logout" onclick="logout()">
                                            <i class="fa-solid fa-unlock-keyhole"></i>
                                            <span class='mt-2'>
                                                Log Out
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='IconMenu'>
                        <span></span>
                        <span class='Active'></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class='content'>
            <!-- menu -->
            <div class='menu'>
                <ul>        
                    <li class='li'>
                        <a href='#' class=''>
                            <i class="fa-solid fa-person-walking-luggage"></i>
                            <span>طلبات التوظيف</span>
                            <i class='fa fa-angle-left'></i>
                        </a>
                        <ul class='mm-collapse'>
                            <li>
                                <a href='../index?employid=<?php echo $employ['employ_id']?>'>
                                    <i class='fas fa-file-invoice'></i>
                                    <span> الطلبات </span>
                                </a>
                            </li>
                            <li>
                                <a href='../del/index?employid=<?php echo $employ['employ_id']?>'>
                                    <i class="fa-solid fa-trash"></i>
                                    <span> المحذوفات </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class='li'>
                        <a href='#' class=''>
                            <i class="fa-solid fa-person-hiking"></i>
                            <span>قائمة المعينيين</span>
                            <i class='fa fa-angle-left'></i>
                        </a>
                        <ul class='mm-collapse'>
                            <li>
                                <a href='../index_appointed?employid=<?php echo $employ['employ_id']?>' class=''>
                                    <i class='fa-solid fa-id-card-clip'></i>
                                    <span> المعينيين  </span>
                                </a>
                            </li>
                            <li>
                                <a href='../del/index_appointed?employid=<?php echo $employ['employ_id']?>'>
                                    <i class="fa-solid fa-trash"></i>
                                    <span> المحذوفات </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class='li'>
                        <a href='#' class='active'>
                            <i class="fa-solid fa-signs-post"></i>
                            <span>قائمة المؤجلين</span>
                            <i class='fa fa-angle-left'></i>
                        </a>
                        <ul class='mm-collapse'>
                            <li>
                                <a href='../index_postpone?employid=<?php echo $employ['employ_id']?>'>
                                    <i class='fa-solid fa-info'></i>
                                    <span> المؤجلين  </span>
                                </a>
                            </li>
                            <li>
                                <a href='../del/index_postpone?employid=<?php echo $employ['employ_id']?>'>
                                    <i class="fa-solid fa-trash"></i>
                                    <span> المحذوفات  </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class='settings'>
                        <a href='../settings?employid=<?php echo $employ['employ_id']?>&mood=create'>
                            <i class="fa-solid fa-gear"></i>
                            <span>الاعدادات</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- show-board -->
            <div class='show-board'>
                <div class='title-info'>
                    <p>بيانات الموظفين</p>    
                    <div class='dropdowns'>
                        <div class='dropdown mx-2 my-2'>
                            <button class='btn dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
                                تصدير
                            </button>
                            <div class='dropdown-menu'>
                                <a class='dropdown-item px-1' onclick="ExportToXLSX('xls')">
                                    <button class='btn btn-info text-center text-light ml-2 w-100'>
                                        التصدير الي إكسيل   
                                    </button>
                                </a>
                                <div class='dropdown-divider m-0'></div>
                                <a class='dropdown-item px-1' onclick="ExportToPDF()">
                                    <button class='btn btn-info text-center text-light ml-2 w-100'>
                                        التصدير الي pdf
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group is-invalid">
                    <form method="post" class="d-flex w-100">
                        <input class="form-control my-2" style="height: 38px;" type="search" placeholder="البحث" id="searchInput" name="searchInput" onkeypress="showdata(this.value)" aria-label="Search">
                        <select class="select my-2" aria-label="search_items" id="search_items" name="search_items">
                            <option value="name">الاسم</option>
                            <option value="date">التاريخ</option>
                            <option value="governorate">المحافظة</option>
                        </select>
                        <button type="submit" name="search" class="btn btn-success my-2"> بحث </button>
                    </form>
                </div>
                <div class='data-info'>
                    <table class='table table-bordered table-striped' id='table'>
                        <thead>
                            <tr class="no">
                                <th>الكود</th>
                                <th>اسم الموظف</th>
                                <th>المحافظة</th>
                                <th>موعد التسجيل</th>
                                <th>الاجراءات </th>
                            </tr>
                        </thead>
                        <tbody id='body-data'>
                            <?php
                                include('../inc/config.php');

                                $database = new PDO("mysql:host=localhost;dbname=roaya_form_cv", "root", "");
                                if(isset($_POST['search'])){
                                    echo "
                                        <script>
                                            let searchInput = document.querySelector('#searchInput');
                                            searchInput.value = '$_POST[searchInput]';
                                            search_items.value = '$_POST[search_items]';
                                        </script>
                                    ";
                                
                                    if($_POST['search_items'] === 'name'){
                                        $full_name = explode(" ", $_POST['searchInput']);
                                        $SEARCH = $database->prepare("SELECT * FROM delete_postpone WHERE CONCAT(first_name, ' ', second_name, ' ', third_name, ' ', last_name) LIKE :value");
                                        $SEARCH_VALUE = "%" .$_POST['searchInput']."%";
                                        $SEARCH->bindParam("value", $SEARCH_VALUE, PDO::PARAM_STR);
                                        $SEARCH->execute();
                                        $i = 1;
                                        foreach($SEARCH AS $row){
                                            echo"
                                                <tr>
                                                    <td>$i</td>
                                                    <td>$row[first_name]". " " . "$row[second_name]" ." " . "$row[third_name]" . " " . "$row[last_name]" ."</td>
                                                    <td>$row[governorate]</td>
                                                    <td>$row[date_Of_date]</td>
                                                    <td>
                                                        <div class='dropdown'>
                                                            <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false' style='padding: 0 !important; height: 35px; width: 55px;'>
                                                                <svg class='svg-inline--fa fa-gear p-1' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='gear' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z'></path></svg><!-- <i class='fa fa-cog p-1'></i> Font Awesome fontawesome.com -->
                                                            </button>
                                                            <div class='dropdown-menu' style='position: absolute; transform: translate3d(2px, 35px, 0px); top: 0px; left: 0px; will-change: transform;' x-placement='bottom-start'>
                                                                <form action='show/show?employid=$employ[employ_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                    <button class='btn btn-primary w-100 my-1'>
                                                                        عــرض
                                                                    </button>
                                                                </form>
                                                                <form action='php/appointed?employid=$employ[employ_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                    <input type='hidden' id='typedatabase' name='typedatabase' value='defult'>
                                                                    <button class='btn btn-success w-100 my-1'>
                                                                        تعيين
                                                                    </button>
                                                                </form>
                                                                <form action='php/postpone?employid=$employ[employ_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                    <input type='hidden' id='typedatabase' name='typedatabase' value='defult'>
                                                                    <button class='btn btn-dark text-white w-100 my-1'>
                                                                        تأجيل
                                                                    </button>
                                                                </form>
                                                                <button type='button' class='btn btn-danger w-100 my-1' data-toggle='modal' data-target='#exampleModal'>
                                                                    حذف
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td> 
                                                    <td>
                                                            <div class='dropdown'>
                                                                <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false' style='padding: 0 !important; height: 35px; width: 55px;'>
                                                                    <svg class='svg-inline--fa fa-gear p-1' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='gear' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z'></path></svg><!-- <i class='fa fa-cog p-1'></i> Font Awesome fontawesome.com -->
                                                                </button>
                                                                <div class='dropdown-menu' style='position: absolute; transform: translate3d(2px, 35px, 0px); top: 0px; left: 0px; will-change: transform;' x-placement='bottom-start'>
                                                                    <form action='show/show.php?userid=$user[user_id]' type='submit' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <button class='btn btn-primary w-100 my-1'>
                                                                            عــرض
                                                                        </button>
                                                                    </form>
                                                                    <form action='../php/appointed.php?userid=$user[user_id]' type='submit' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                        <button class='btn btn-success w-100 my-1'>
                                                                            تعيين
                                                                        </button>
                                                                    </form>
                                                                    <form action='../php/postpone.php?userid=$user[user_id]' type='submit' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                        <button class='btn btn-dark text-white w-100 my-1'>
                                                                            تأجيل
                                                                        </button>
                                                                    </form>
                                                                    <form action='acc_del.php?userid=$user[user_id]' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                        <button class='btn btn-danger w-100 my-1' type='submit'>
                                                                            حذف
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>                 
                                                </tr>
                                            ";
                                            $i += 1;
                                        }
                                    }elseif($_POST['search_items'] == 'date'){
                                        $SEARCH = $database->prepare("SELECT * FROM delete_postpone WHERE date_Of_date LIKE :value");
                                        $SEARCH_VALUE = "%" .$_POST['searchInput']."%";
                                        $SEARCH->bindParam("value", $SEARCH_VALUE, PDO::PARAM_STR);
                                        $SEARCH->execute();
                                        $i = 1;
                                        foreach($SEARCH AS $row){
                                            echo"
                                                <tr>
                                                    <td>$i</td>
                                                    <td>$row[first_name]". " " . "$row[second_name]" ." " . "$row[third_name]" . " " . "$row[last_name]" ."</td>
                                                    <td>$row[governorate]</td>
                                                    <td>$row[date_Of_date]</td>
                                                    <td>
                                                        <div class='dropdown'>
                                                            <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false' style='padding: 0 !important; height: 35px; width: 55px;'>
                                                                <svg class='svg-inline--fa fa-gear p-1' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='gear' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z'></path></svg><!-- <i class='fa fa-cog p-1'></i> Font Awesome fontawesome.com -->
                                                            </button>
                                                            <div class='dropdown-menu' style='position: absolute; transform: translate3d(2px, 35px, 0px); top: 0px; left: 0px; will-change: transform;' x-placement='bottom-start'>
                                                                <form action='show/show?employid=$employ[employ_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                    <button class='btn btn-primary w-100 my-1'>
                                                                        عــرض
                                                                    </button>
                                                                </form>
                                                                <form action='php/appointed?employid=$employ[employ_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                    <input type='hidden' id='typedatabase' name='typedatabase' value='defult'>
                                                                    <button class='btn btn-success w-100 my-1'>
                                                                        تعيين
                                                                    </button>
                                                                </form>
                                                                <form action='php/postpone?employid=$employ[employ_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                    <input type='hidden' id='typedatabase' name='typedatabase' value='defult'>
                                                                    <button class='btn btn-dark text-white w-100 my-1'>
                                                                        تأجيل
                                                                    </button>
                                                                </form>
                                                                <button type='button' class='btn btn-danger w-100 my-1' data-toggle='modal' data-target='#exampleModal'>
                                                                    حذف
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td> 
                                                    <td>
                                                            <div class='dropdown'>
                                                                <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false' style='padding: 0 !important; height: 35px; width: 55px;'>
                                                                    <svg class='svg-inline--fa fa-gear p-1' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='gear' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z'></path></svg><!-- <i class='fa fa-cog p-1'></i> Font Awesome fontawesome.com -->
                                                                </button>
                                                                <div class='dropdown-menu' style='position: absolute; transform: translate3d(2px, 35px, 0px); top: 0px; left: 0px; will-change: transform;' x-placement='bottom-start'>
                                                                    <form action='show/show.php?userid=$user[user_id]' type='submit' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <button class='btn btn-primary w-100 my-1'>
                                                                            عــرض
                                                                        </button>
                                                                    </form>
                                                                    <form action='../php/appointed.php?userid=$user[user_id]' type='submit' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                        <button class='btn btn-success w-100 my-1'>
                                                                            تعيين
                                                                        </button>
                                                                    </form>
                                                                    <form action='../php/postpone.php?userid=$user[user_id]' type='submit' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                        <button class='btn btn-dark text-white w-100 my-1'>
                                                                            تأجيل
                                                                        </button>
                                                                    </form>
                                                                    <form action='acc_del.php?userid=$user[user_id]' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                        <button class='btn btn-danger w-100 my-1' type='submit'>
                                                                            حذف
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>                 
                                                </tr>
                                            ";
                                            $i += 1;
                                        }
                                    }elseif($_POST['search_items'] == 'governorate'){
                                        $SEARCH = $database->prepare("SELECT * FROM delete_postpone WHERE governorate LIKE :value");
                                        $SEARCH_VALUE = "%" .$_POST['searchInput']."%";
                                        $SEARCH->bindParam("value", $SEARCH_VALUE, PDO::PARAM_STR);
                                        $SEARCH->execute();
                                        $i = 1;
                                        foreach($SEARCH AS $row){
                                            echo"
                                                <tr>
                                                    <td>$i</td>
                                                    <td>$row[first_name]". " " . "$row[second_name]" ." " . "$row[third_name]" . " " . "$row[last_name]" ."</td>
                                                    <td>$row[governorate]</td>
                                                    <td>$row[date_Of_date]</td>
                                                    <td>
                                                        <div class='dropdown'>
                                                            <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false' style='padding: 0 !important; height: 35px; width: 55px;'>
                                                                <svg class='svg-inline--fa fa-gear p-1' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='gear' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z'></path></svg><!-- <i class='fa fa-cog p-1'></i> Font Awesome fontawesome.com -->
                                                            </button>
                                                            <div class='dropdown-menu' style='position: absolute; transform: translate3d(2px, 35px, 0px); top: 0px; left: 0px; will-change: transform;' x-placement='bottom-start'>
                                                                <form action='show/show?employid=$employ[employ_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                    <button class='btn btn-primary w-100 my-1'>
                                                                        عــرض
                                                                    </button>
                                                                </form>
                                                                <form action='php/appointed?employid=$employ[employ_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                    <input type='hidden' id='typedatabase' name='typedatabase' value='defult'>
                                                                    <button class='btn btn-success w-100 my-1'>
                                                                        تعيين
                                                                    </button>
                                                                </form>
                                                                <form action='php/postpone?employid=$employ[employ_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                    <input type='hidden' id='typedatabase' name='typedatabase' value='defult'>
                                                                    <button class='btn btn-dark text-white w-100 my-1'>
                                                                        تأجيل
                                                                    </button>
                                                                </form>
                                                                <button type='button' class='btn btn-danger w-100 my-1' data-toggle='modal' data-target='#exampleModal'>
                                                                    حذف
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td> 
                                                    <td>
                                                            <div class='dropdown'>
                                                                <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false' style='padding: 0 !important; height: 35px; width: 55px;'>
                                                                    <svg class='svg-inline--fa fa-gear p-1' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='gear' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z'></path></svg><!-- <i class='fa fa-cog p-1'></i> Font Awesome fontawesome.com -->
                                                                </button>
                                                                <div class='dropdown-menu' style='position: absolute; transform: translate3d(2px, 35px, 0px); top: 0px; left: 0px; will-change: transform;' x-placement='bottom-start'>
                                                                    <form action='show/show.php?userid=$user[user_id]' type='submit' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <button class='btn btn-primary w-100 my-1'>
                                                                            عــرض
                                                                        </button>
                                                                    </form>
                                                                    <form action='../php/appointed.php?userid=$user[user_id]' type='submit' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                        <button class='btn btn-success w-100 my-1'>
                                                                            تعيين
                                                                        </button>
                                                                    </form>
                                                                    <form action='../php/postpone.php?userid=$user[user_id]' type='submit' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                        <button class='btn btn-dark text-white w-100 my-1'>
                                                                            تأجيل
                                                                        </button>
                                                                    </form>
                                                                    <form action='acc_del.php?userid=$user[user_id]' method='post'>
                                                                        <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                        <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                        <button class='btn btn-danger w-100 my-1' type='submit'>
                                                                            حذف
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>                 
                                                </tr>
                                            ";

                                            $i += 1;
                                        }
                                    }   
                                }else{
                                    include('../inc/config.php');
                                    $result = mysqli_query($conection,"SELECT * FROM delete_postpone");
                                    $i = 1;
                                    while($row = mysqli_fetch_array($result)){
                                        echo"
                                            <tr>
                                                <td>$i</td>
                                                <td>$row[first_name]". " " . "$row[second_name]" ." " . "$row[third_name]" . " " . "$row[last_name]" ."</td>
                                                <td>$row[governorate]</td>
                                                <td>$row[date_Of_date]</td>
                                                <td>
                                                    <div class='dropdown'>
                                                        <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false' style='padding: 0 !important; height: 35px; width: 55px;'>
                                                            <svg class='svg-inline--fa fa-gear p-1' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='gear' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z'></path></svg><!-- <i class='fa fa-cog p-1'></i> Font Awesome fontawesome.com -->
                                                        </button>
                                                        <div class='dropdown-menu' style='position: absolute; transform: translate3d(2px, 35px, 0px); top: 0px; left: 0px; will-change: transform;' x-placement='bottom-start'>
                                                            <form action='show/show?employid=$employ[employ_id]' type='submit' method='post'>
                                                                <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                <button class='btn btn-primary w-100 my-1'>
                                                                    عــرض
                                                                </button>
                                                            </form>
                                                            <form action='php/appointed?employid=$employ[employ_id]' type='submit' method='post'>
                                                                <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                <input type='hidden' id='typedatabase' name='typedatabase' value='defult'>
                                                                <button class='btn btn-success w-100 my-1'>
                                                                    تعيين
                                                                </button>
                                                            </form>
                                                            <form action='php/postpone?employid=$employ[employ_id]' type='submit' method='post'>
                                                                <input type='hidden' id='id' name='id' value='$row[employ_id]'>
                                                                <input type='hidden' id='typedatabase' name='typedatabase' value='defult'>
                                                                <button class='btn btn-dark text-white w-100 my-1'>
                                                                    تأجيل
                                                                </button>
                                                            </form>
                                                            <button type='button' class='btn btn-danger w-100 my-1' data-toggle='modal' data-target='#exampleModal'>
                                                                حذف
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td> 
                                                <td>
                                                        <div class='dropdown'>
                                                            <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false' style='padding: 0 !important; height: 35px; width: 55px;'>
                                                                <svg class='svg-inline--fa fa-gear p-1' aria-hidden='true' focusable='false' data-prefix='fas' data-icon='gear' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z'></path></svg><!-- <i class='fa fa-cog p-1'></i> Font Awesome fontawesome.com -->
                                                            </button>
                                                            <div class='dropdown-menu' style='position: absolute; transform: translate3d(2px, 35px, 0px); top: 0px; left: 0px; will-change: transform;' x-placement='bottom-start'>
                                                                <form action='show/show.php?userid=$user[user_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                    <button class='btn btn-primary w-100 my-1'>
                                                                        عــرض
                                                                    </button>
                                                                </form>
                                                                <form action='../php/appointed.php?userid=$user[user_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                    <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                    <button class='btn btn-success w-100 my-1'>
                                                                        تعيين
                                                                    </button>
                                                                </form>
                                                                <form action='../php/postpone.php?userid=$user[user_id]' type='submit' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                    <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                    <button class='btn btn-dark text-white w-100 my-1'>
                                                                        تأجيل
                                                                    </button>
                                                                </form>
                                                                <form action='acc_del.php?userid=$user[user_id]' method='post'>
                                                                    <input type='hidden' id='id' name='id' value='$row[user_id]'>
                                                                    <input type='hidden' id='typedatabase' name='typedatabase' value='delete_postpone'>
                                                                    <button class='btn btn-danger w-100 my-1' type='submit'>
                                                                        حذف
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>                 
                                            </tr>
                                        ";
                                        $i += 1;
                                    }
                                }
                                
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- alert -->
        <div class="alert alert-success d-none" role="alert" id="alert"></div>
        <!-- js files -->
        <script src='../js/logout_2.js'></script>
        <script src='../js/main.js'></script>
        <script src='../js/jquery-3.7.0.min.js'></script>
        <script src='../js/popper.min.js'></script>
        <script src='../js/bootstrap.js'></script>
        <script src='../js/all.min.js'></script>
        <script src='../js/menu.js'></script>
        <script src='../js/staff_data.js'></script>
        <script src='../js/unpkg.com_xlsx@0.15.1_dist_xlsx.full.min.js'></script>
        <script src='../js/pdf.bundle.min.js'></script>
        <script src='../js/pdf.bundle.js'></script>
        <script src='../js/export.js'></script>
        <script>
            let name =document.querySelector('#employ_Name_Show');
            name.innerHTML = "<?php echo $employ['employ_name']?>";
        </script>
        <script>
            if(<?php echo $employ['ability']?> == true){
                document.querySelector('.settings').style.display = 'block';
            }else{
                document.querySelector('.settings').style.display = 'none';
            }
        </script>
    </body>
</html>