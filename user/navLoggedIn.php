<section id="userarea">
    <section id="usercontainer" class="hc">
        <div id="user-menu">
            <section class="username-settings">
                <h2 class=""><?php echo $_SESSION['username']; ?></h2>
                <svg fill="#FFFFFF"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
            </section>
            <ul id="menu">
                <li id="change-email" class="user-menu-item">Byt e-post</li>
                <li id="change-password" class="user-menu-item">Byt lösenord</li>
                <a href="php/logout.php"><li id="change-password" class="user-menu-item">Logga ut</li></a>
            </ul>
        </div>
    </section>
</section>
