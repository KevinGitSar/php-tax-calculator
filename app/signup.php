<?php
include "view/header.php";
?>

<div>
    <form class="mx-auto w-1/2" action="controller/process_signup.php" method="POST">
        
        <h1 class="text-center">Sign up!</h1>

        <div class="pt-5">
            <label for="email">E-mail: </label>
            <input type="email" id="email" name="email" placeholder="Enter Email" class="inline-block w-full p-2 background bg-[#f1f1f1] border-2 border-black rounded invalid:border-red-500 focus:bg-[#ddd]" />
        </div>

        <div class="pt-5">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" class="inline-block w-full p-2 background bg-[#f1f1f1] border-2 border-black rounded invalid:border-red-500 focus:bg-[#ddd]" />
        </div>

        <div class="pt-5">
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" class="inline-block w-full p-2 background bg-[#f1f1f1] border-2 border-black rounded invalid:border-red-500 focus:bg-[#ddd]" />
        </div>

        <div class="pt-5">
            <label for="confirm_password">Confirm Password: </label>
            <input type="password" id="confirm_password" name="confirm_password" class="inline-block w-full p-2 background bg-[#f1f1f1] border-2 border-black rounded invalid:border-red-500 focus:bg-[#ddd]" />
        </div>
        <button type="submit" class="border-2 border-black rounded text-center mt-5 px-5">Sign up</button>
    </form>
</div>

<?php include 'view/footer.php'; ?>