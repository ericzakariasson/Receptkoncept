<section id="main-register" class="user-popup">
    <div>
        <h2>Registrera</h2>
    </div>
    <form id="registerForm" method="POST">
        <label for="usernameR">Användarnamn</label>
        <input id="usernameR" type="text" name="username" autofocus required maxlength="16">
        <label for="emailR">E-post</label>
        <input id="emailR" type="email" name="email" required maxlength="64">
        <label for="passwordR">Lösenord</label> 
        <input id="passwordR" class="passwordR" type="password" name="password" required maxlength="64">
        <label for="password2R">Upprepa lösenord</label>
        <input id="password2R" class="passwordR" type="password" name="password2" required maxlength="64">
        <button type="submit">Registrera</button>
    </form>
</section>
