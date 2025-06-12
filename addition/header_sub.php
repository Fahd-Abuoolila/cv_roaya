<div class='header'>
    <div>
        <div class="right">
            <a href='index' class='navbar-brand'>
                <img src='../img/Roaya.png' alt='' draggable='false'>
            </a>
            <i class="fa-solid fa-bars-staggered"></i>
        </div>
        <div id='nav'> 
            <div class='collapse navbar-collapse mx-2'>
                <div>
                    <div class='dropdowns'>
                        <div class='dropdown mx-2 my-2'>
                            <button class='btn dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
                                <span id='employ_Name_Show'>
                                    <?php echo $user['employ_name']?>
                                </span>
                            </button>
                            <div class='dropdown-menu'>
                                <a class='dropdown-item' id="name" onclick="copyToClipboard(this.id)">
                                    <i class="fa-regular fa-user"></i>
                                    <p class='mx-2'>
                                        <?php echo $user['employ_name']?>
                                    </p>
                                </a>
                                <div class='dropdown-divider m-0'></div>
                                <a class='dropdown-item' id="email" onclick="copyToClipboard(this.id)">
                                    <i class="fa-regular fa-envelope"></i>
                                    <p class='mx-2'>
                                        <?php echo $user['employ_email']?>
                                    </p>
                                </a>
                                <div class='dropdown-divider m-0'></div>
                                <a class='dropdown-item bg-danger text-center text-light' style="cursor: pointer; border-radius: 0 0 3.5px 3.5px;" id="Roayaut">
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
        </div>
    </div>
</div>